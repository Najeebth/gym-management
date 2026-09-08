<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class WhatsAppService
{
    /**
     * Send the approved welcome template to an opted-in client.
     *
     * @return array<string, mixed>|null
     */
    public function sendClientWelcome(Client $client): ?array
    {
        if (! config('services.whatsapp.enabled')) {
            return null;
        }

        $token = config('services.whatsapp.access_token');
        $phoneNumberId = config('services.whatsapp.phone_number_id');

        if (! $token || ! $phoneNumberId) {
            throw new RuntimeException(
                'WhatsApp is enabled but its Cloud API credentials are incomplete.'
            );
        }

        try {
            $response = Http::acceptJson()
                ->withToken($token)
                ->retry(2, 250, throw: false)
                ->post($this->messagesUrl($phoneNumberId), [
                    'messaging_product' => 'whatsapp',
                    'to' => ltrim($client->phone, '+'),
                    'type' => 'template',
                    'template' => [
                        'name' => config('services.whatsapp.welcome_template'),
                        'language' => [
                            'code' => config('services.whatsapp.template_language'),
                        ],
                        'components' => [[
                            'type' => 'body',
                            'parameters' => [[
                                'type' => 'text',
                                'text' => $client->full_name,
                            ]],
                        ]],
                    ],
                ]);
        } catch (ConnectionException $exception) {
            throw new RuntimeException(
                'Could not connect to the WhatsApp Cloud API.',
                previous: $exception,
            );
        }

        $response->throw();

        return $response->json();
    }

    private function messagesUrl(string $phoneNumberId): string
    {
        return sprintf(
            'https://graph.facebook.com/%s/%s/messages',
            config('services.whatsapp.graph_version'),
            $phoneNumberId,
        );
    }
}
