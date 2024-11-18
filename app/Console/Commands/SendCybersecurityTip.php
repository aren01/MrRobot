<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use JoliCode\Slack\ClientFactory;
use JoliCode\Slack\Exception\SlackErrorResponse;
use Illuminate\Support\Facades\Log;

class SendCybersecurityTip extends Command
{
    protected $signature = 'send:cybersecurity-tip';
    protected $description = 'Send a daily cybersecurity tip to a Slack channel';

    protected $client;

    public function __construct()
    {
        parent::__construct();
        $this->client = ClientFactory::create(env('SLACK_BOT_TOKEN'));
    }

    public function handle()
    {
        $tip = $this->getRandomCybersecurityTip();
        $channel = '#tips'; // Change this to your desired Slack channel

        try {
            $response = $this->client->chatPostMessage([
                'channel' => $channel,
                'text' => $tip,
            ]);
            Log::info('Cybersecurity tip sent successfully!', (array) $response);
            $this->info('Cybersecurity tip sent successfully!');
        } catch (\Exception $e) {
            Log::error('Slack API Error: ' . $e->getMessage());
            $this->error('Failed to send cybersecurity tip.');
        }
    }

    protected function getRandomCybersecurityTip()
    {
        $tips = [
            "Today's tip: Use strong, unique passwords for every account.",
            "Be cautious of unsolicited emails and avoid clicking on suspicious links.",
            "Enable two-factor authentication (2FA) on your accounts.",
            "Keep your software and operating systems updated.",
            "Back up your data regularly to prevent data loss.",
            "Use a reputable antivirus and keep it updated.",
            "Be wary of public Wi-Fi and consider using a VPN.",
            "Regularly review your privacy settings on social media.",
            "Be mindful of the information you share online.",
            "Educate yourself about the latest cybersecurity threats."
        ];

        return $tips[array_rand($tips)];
    }
}
