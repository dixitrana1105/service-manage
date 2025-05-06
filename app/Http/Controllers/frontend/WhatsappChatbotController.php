<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\WhatsAppChatbot;
use App\Models\ThemeSection;
use Illuminate\Http\Request;

class WhatsappChatbotController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfile::all(); // Retrieve the first profile
        $chatbots = WhatsAppChatbot::all(); // This fetches the dynamic data
        $banner = ThemeSection::all(); // example logic
        return view('frontend.whatsapp-chatbot', compact('companyProfile', 'chatbots', 'banner'));
    }
}
