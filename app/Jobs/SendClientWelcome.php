<?php

namespace App\Jobs;

use App\Models\Client;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendClientWelcome implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public Client $client)
    {
    }

    public function handle(WhatsAppService $whatsApp): void
    {
        if (! $this->client->whatsapp_opt_in_at) {
            return;
        }

        try {
            $whatsApp->sendClientWelcome($this->client);
        } catch (Throwable $exception) {
            Log::warning('Unable to send client WhatsApp welcome message.', [
                'client_id' => $this->client->id,
                'exception' => $exception,
            ]);
        }
    }
}
