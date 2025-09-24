<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration by sending a test email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        try {
            Mail::raw('This is a test email from EricShop. Email configuration is working!', function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email from EricShop')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            
            $this->info("✅ Test email sent successfully to {$email}!");
            $this->info("📧 Please check your inbox (and spam folder).");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            $this->info("🔧 Please check your .env mail configuration:");
            $this->info("   - MAIL_MAILER: " . config('mail.default'));
            $this->info("   - MAIL_HOST: " . config('mail.mailers.smtp.host'));
            $this->info("   - MAIL_PORT: " . config('mail.mailers.smtp.port'));
            $this->info("   - MAIL_USERNAME: " . config('mail.mailers.smtp.username'));
            $this->info("   - MAIL_FROM_ADDRESS: " . config('mail.from.address'));
        }
        
        return 0;
    }
}
