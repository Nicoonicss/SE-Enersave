<?php

class EmailHelper
{
    /**
     * Send password reset email
     */
    public static function sendPasswordResetEmail(string $email, string $token): bool
    {
        $resetUrl = self::getBaseUrl() . '/reset-password?token=' . urlencode($token);
        
        $subject = 'Reset Your Password - Enersave';
        $message = self::getPasswordResetEmailTemplate($email, $resetUrl);
        $headers = self::getEmailHeaders();
        
        return mail($email, $subject, $message, $headers);
    }
    
    /**
     * Get the base URL for the application
     */
    private static function getBaseUrl(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return $protocol . '://' . $host;
    }
    
    /**
     * Get email headers
     */
    private static function getEmailHeaders(): string
    {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: Enersave <noreply@enersave.com>\r\n";
        $headers .= "Reply-To: noreply@enersave.com\r\n";
        return $headers;
    }
    
    /**
     * Get password reset email template
     */
    private static function getPasswordResetEmailTemplate(string $email, string $resetUrl): string
    {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .button { display: inline-block; padding: 12px 24px; background-color: #27ae60; color: #000000 !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 20px 0; }
                .footer { margin-top: 30px; font-size: 12px; color: #666; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Reset Your Password</h2>
                <p>Hello,</p>
                <p>We received a request to reset your password for your Enersave account associated with <strong>{$email}</strong>.</p>
                <p>Click the button below to reset your password:</p>
                <p><a href='{$resetUrl}' class='button' style='color: #000000;'>Reset Password</a></p>
                <p>Or copy and paste this link into your browser:</p>
                <p style='word-break: break-all; color: #2563eb;'>{$resetUrl}</p>
                <p>This link will expire in 1 hour for security reasons.</p>
                <p>If you didn't request a password reset, please ignore this email.</p>
                <div class='footer'>
                    <p>Best regards,<br>The Enersave Team</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}

