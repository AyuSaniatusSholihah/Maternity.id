<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminVerificationController extends Controller
{
    public function dashboard(): mixed
    {
        return view('admin.dashboard', [
            'adminVerifications' => $this->verificationRows(),
        ]);
    }

    public function approve(Request $request, string $eventId, string $userId): mixed
    {
        $registration = DB::table('event_registration')
            ->join('events', 'event_registration.event_id', '=', 'events.id')
            ->join('members', 'event_registration.user_id', '=', 'members.account_id')
            ->join('accounts', 'members.account_id', '=', 'accounts.id')
            ->where('event_registration.event_id', $eventId)
            ->where('event_registration.user_id', $userId)
            ->select([
                'event_registration.payment_status',
                'events.title as event_title',
                'events.slug as event_slug',
                'members.name',
                'accounts.email',
            ])
            ->first();

        abort_unless($registration, 404);

        DB::table('event_registration')
            ->where('event_id', $eventId)
            ->where('user_id', $userId)
            ->update([
                'payment_status' => 'approved',
                'reviewer_id' => $request->user()->id,
                'reviewed_at' => now(),
                'message' => 'Pembayaran telah diverifikasi admin.',
                'updated_at' => now(),
            ]);

        $message = 'Pendaftaran '.$registration->event_title.' telah disetujui. Silakan cek email Anda untuk informasi selanjutnya.';

        DB::table('account_notifications')->insert([
            'account_id' => $userId,
            'type' => 'payment',
            'title' => 'Pendaftaran Berhasil Diverifikasi',
            'message' => $message,
            'url' => route('events.approved', $registration->event_slug),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        try {
            Mail::raw(
                "Halo {$registration->name},\n\n{$message}\n\nTerima kasih,\nMaternity.id",
                fn ($mail) => $mail->to($registration->email)
                    ->subject('Pendaftaran Event Berhasil Diverifikasi - Maternity.id')
            );
        } catch (\Throwable $exception) {
            Log::error('Gagal mengirim email approval event.', [
                'event_id' => $eventId,
                'user_id' => $userId,
                'error' => $exception->getMessage(),
            ]);
        }

        $successMessage = 'Pendaftaran berhasil disetujui dan notifikasi telah dibuat.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $successMessage,
                'status' => 'approved',
            ]);
        }

        return back()->with('status', $successMessage);
    }

    public function notifications(Request $request): JsonResponse
    {
        $notifications = DB::table('account_notifications')
            ->where('account_id', $request->user()->id)
            ->latest()
            ->limit(20)
            ->get()
            ->map(fn ($notification): array => [
                'id' => $notification->id,
                'type' => $notification->type,
                'status' => str_contains(strtolower($notification->title), 'berhasil') ? 'approved' : 'pending',
                'title' => $notification->title,
                'message' => $notification->message,
                'time' => $notification->created_at,
                'read' => (bool) $notification->read_at,
                'url' => $notification->url ?: route('home'),
                'icon' => str_contains(strtolower($notification->title), 'berhasil') ? 'fa-circle-check' : 'fa-clock',
                'iconBg' => str_contains(strtolower($notification->title), 'berhasil') ? 'bg-green-100' : 'bg-amber-100',
                'iconColor' => str_contains(strtolower($notification->title), 'berhasil') ? 'text-green-600' : 'text-amber-500',
                'badge' => str_contains(strtolower($notification->title), 'berhasil') ? 'Disetujui' : 'Menunggu',
                'badgeBg' => str_contains(strtolower($notification->title), 'berhasil')
                    ? 'bg-green-100 text-green-700'
                    : 'bg-amber-100 text-amber-700',
            ]);

        return response()->json($notifications);
    }

    private function verificationRows()
    {
        return DB::table('event_registration')
            ->join('events', 'event_registration.event_id', '=', 'events.id')
            ->join('members', 'event_registration.user_id', '=', 'members.account_id')
            ->join('accounts', 'members.account_id', '=', 'accounts.id')
            ->select([
                'event_registration.event_id',
                'event_registration.user_id',
                'event_registration.payment_status',
                'event_registration.proof_img_url',
                'event_registration.created_at',
                'events.title as event_title',
                'events.fee',
                'events.categories',
                'members.name',
                'members.phone',
                'members.date_of_birth',
                'accounts.email',
            ])
            ->latest('event_registration.created_at')
            ->get()
            ->map(fn ($registration): array => [
                'id' => $registration->event_id.'-'.$registration->user_id,
                'eventId' => $registration->event_id,
                'userId' => $registration->user_id,
                'userName' => $registration->name,
                'userEmail' => $registration->email,
                'userWhatsapp' => $registration->phone ?: '-',
                'userBirthDate' => $registration->date_of_birth ?: '-',
                'eventName' => $registration->event_title,
                'packageType' => strtoupper($registration->categories),
                'amount' => 'Rp '.number_format($registration->fee, 0, ',', '.'),
                'date' => $registration->created_at,
                'status' => $registration->payment_status,
                'proofUrl' => $registration->proof_img_url
                    ? Storage::disk('public')->url($registration->proof_img_url)
                    : null,
            ])
            ->values()
            ->all();
    }
}
