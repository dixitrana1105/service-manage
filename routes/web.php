<?php

// app/Http/Controllers/web.php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyGrowthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\adminlogincontroller;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ThemeSectionController;
use App\Http\Controllers\Admin\TicketFeatureController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\WhatsappFlowController;
use App\Http\Controllers\Admin\DoctorAppointmentController; // Doctor Appointment For Admin
use App\Http\Controllers\Admin\WhatsAppPreviewController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\WhatsAppChatbotController as AdminWhatsAppChatbotController;
use App\Http\Controllers\Admin\FeatureController; // Feature For Admin
use App\Http\Controllers\Admin\FeatureDetailSectionController; // Feature Detail Section For Admin
use App\Http\Controllers\Admin\AdminBusinessAutomationController;
use App\Http\Controllers\frontend\WhyController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\TeamController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\FeatureFrontendController; // Feature Frontend for Frontend
use App\Http\Controllers\frontend\WhatsappChatbotController;
use App\Http\Controllers\frontend\BusinessAutomationController;
use App\Http\Controllers\frontend\Logincontroller;
use App\Http\Controllers\frontend\frontPageController;
use App\Http\Controllers\AppointmentController; // Doctor Appointment For Frontend
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerAppointmentController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\WhySectionController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\HomeController as FrontendHomeController;
use App\Http\Controllers\WhatsappAppointmentController;
use App\Http\Controllers\Admin\ServiceDetailSectionsController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\BroadcastController; // Broadcast Controller
use App\Http\Controllers\FrontController;   // Frontend Controller For Broadcast



// ------------------------------------
// Optimize Clear Route (for Development)
// ------------------------------------
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return response()->json(['message' => 'Optimization cache cleared successfully.']);
});
// ------------------------------------
// frontend Routes
// ------------------------------------
// Route for clearing cache
Route::get('/clear-cache', [HomeController::class, 'clearCache'])->name('home.clearCache');
Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [Logincontroller::class, 'login'])->name('account.login');
        Route::post('/login', [Logincontroller::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [Logincontroller::class, 'register'])->name('account.register');
        Route::post('/process-register', [Logincontroller::class, 'processRegister'])->name('account.processRegister');

    });
});

// Route for displaying the Features section
Route::get('/features', [FeatureFrontendController::class, 'index'])->name('features.frontend');
Route::get('/features/{id}', [FeatureFrontendController::class, 'show'])->name('feature.detail');
Route::get('/features/{id}/details', [FeatureFrontendController::class, 'show'])->name('frontend.feature-detail');


Route::get('/home', [FrontendHomeController::class, 'index'])->name('home');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::get('page/{slug}', [frontPageController::class, 'show'])->name('pages.show');
Route::get('services/{slug}/{id}', [FrontPageController::class, 'services'])->name('services.show');


Route::get('/book-appointment', [WhatsappAppointmentController::class, 'bookAppointmentForm'])->name('appointment.form');
Route::post('/book-appointment', [WhatsappAppointmentController::class, 'submitAppointment'])->name('appointment.submit');

Route::prefix('admin')->group(function () {
    Route::get('company-profile', [CompanyProfileController::class, 'index'])->name('admin.company-profile.index');
    Route::post('company-profile', [CompanyProfileController::class, 'update'])->name('admin.company-profile.update');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('clients', ClientController::class);
});
//Route for displaying the Why section
Route::get('/why', [WhyController::class, 'index']);
// Route::prefix('admin')->group(function () {
//     Route::get('/why', [WhySectionController::class, 'index'])->name('admin.why.index');
//     Route::get('/why/create', [WhySectionController::class, 'create'])->name('admin.why.create');
//     Route::post('/why/store', [WhySectionController::class, 'store'])->name('admin.why.store');
// });
Route::get('/admin/why/edit/{id}', [WhySectionController::class, 'edit'])->name('admin.why.edit');
Route::put('/admin/why/update/{id}', [WhySectionController::class, 'update'])->name('admin.why.update');
Route::delete('/admin/why/destroy/{id}', [WhySectionController::class, 'destroy'])->name('admin.why.destroy');

Route::get('/team', [TeamController::class, 'index']);
// Admin routes to manage team members
Route::get('/admin/teams', [AdminTeamController::class, 'index'])->name('admin.team.index');
Route::get('/admin/teams/create', [AdminTeamController::class, 'create'])->name('admin.team.create');
Route::post('/admin/teams', [AdminTeamController::class, 'store'])->name('admin.team.store');
Route::get('/admin/teams/{id}/edit', [AdminTeamController::class, 'edit'])->name('admin.team.edit');
Route::put('/admin/teams/{id}', [AdminTeamController::class, 'update'])->name('admin.team.update');
Route::delete('/admin/teams/{id}', [AdminTeamController::class, 'destroy'])->name('admin.team.destroy');

// Frontend broadcast display
Route::get('/broadcasts/latest', [FrontController::class, 'latestBroadcasts'])->name('broadcasts.latest');
Route::get('/broadcasts/date/{date}', [HomeController::class, 'byDate'])->name('broadcasts.byDate');


// Route for Subscriber In Admin And Frontend
// Subscription Routes
Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');
Route::get('/admin/subscribers', [SubscribeController::class, 'adminIndex'])->name('admin.subscribers');
Route::delete('/admin/subscribers/{id}', [SubscribeController::class, 'destroy'])->name('admin.subscribers.destroy');
Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');
Route::post('/unsubscribe', [SubscribeController::class, 'unsubscribe'])->name('front.unsubscribe');

// Unsubscribe Route
// Route::post('/unsubscribe', [SubscribeController::class, 'unsubscribe'])->name('unsubscribe');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::prefix('admin')->group(function () {
    // ------------------------------------
    // Admin routes for About Section
    // ------------------------------------
    Route::get('about', [AdminAboutController::class, 'index'])->name('admin.about.index');
    Route::get('about/create', [AdminAboutController::class, 'create'])->name('admin.about.create');
    Route::post('about/store', [AdminAboutController::class, 'store'])->name('admin.about.store');
    Route::get('about/edit/{id}', [AdminAboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('about/update/{id}', [AdminAboutController::class, 'update'])->name('admin.about.update');
    Route::delete('about/destroy/{id}', [AdminAboutController::class, 'destroy'])->name('admin.about.destroy');
    // ------------------------------------
});
Route::get('/get-slug', [App\Http\Controllers\Admin\PageController::class, 'getSlug'])->name('getSlug');
Route::prefix('admin')->group(function () {
    // Admin routes for managing services
    Route::get('services', [ServiceController::class, 'adminIndex'])->name('admin.services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
});

Route::prefix('customer')->group(function () {
    Route::get('appointment', [CustomerAppointmentController::class, 'create'])->name('customer.appointment.create');
    Route::post('appointment', [CustomerAppointmentController::class, 'store'])->name('customer.appointment.store');
});

// Frontend
Route::prefix('doctorappoinment')->group(function () {
    Route::get('book-doctor-appoinment', [AppointmentController::class, 'create'])->name('doctorappoinment.create');
    Route::post('book-appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    // Route::get('book-appointment', [AppointmentController::class, 'showAppointmentForm'])->name('appointment.show');
});

// frontend route for displaying services
Route::get('services', [ServiceController::class, 'index'])->name('frontend.services.index');
Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');
Route::get('/services/{id}/details', [ServiceController::class, 'showServiceDetails'])->name('frontend.services.details');

Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/why', [WhyController::class, 'index'])->name('why.index');
Route::get('/business-automation', [BusinessAutomationController::class, 'index'])->name('business-automation.index');
Route::get('/whatsapp-chatbot', [WhatsappChatbotController::class, 'index'])->name('whatsapp-chatbot.index');
// Route::get('frontend/login', [Logincontroller::class, 'login'])->name('account.login');
// Route::post('frontend/login', [Logincontroller::class, 'authenticate'])->name('account.authenticate');
// Route::get('frontend/register', [Logincontroller::class, 'register'])->name('account.register');
Route::get('frontend/profile', [Logincontroller::class, 'profile'])->name('account.profile');
Route::get('frontend/logout', [Logincontroller::class, 'logout'])->name('account.logout');
// Route::post('/process-register', [Logincontroller::class, 'processRegister'])->name('account.processRegister');
Route::get('/change-password', [Logincontroller::class, 'showChangePasswordForm'])->name('account.changePassword');
Route::post('/process-change-password', [AuthController::class, 'changePassword'])->name('account.processChangePassword');
Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');
Route::post('/update-address', [AuthController::class, 'updateAddress'])->name('account.updateAddress');



//Route::get('/blog', [BlogController::class, 'index']);
//Route::get('/blog/{id}', [BlogController::class, 'show']);



// ------------------------------------
// Create - Footer Management Routes
// ------------------------------------

// frontend route
// ------------------------------------
// Clear Cache Route (for Development)
// ------------------------------------
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return response()->json(['message' => 'Optimization cache cleared successfully.']);
});

// ------------------------------------
// Admin Panel Routes
// ------------------------------------

// ------------------------------------
// BusinessAutomation  Management Routes
// ------------------------------------
Route::get('admin/business-automation', [AdminBusinessAutomationController::class, 'index'])->name('admin.business-automation.index');
Route::post('admin/business-automation', [AdminBusinessAutomationController::class, 'store'])->name('admin.business-automation.store');

Route::prefix('admin')->group(function () {

    // ------------------------------------
    // Admin Guest Routes (For Login/Registration)
    // ------------------------------------
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/Registration', [AdminLoginController::class, 'registration'])->name('admin.registration');
        Route::post('/register-users', [AdminLoginController::class, 'registerUsers'])->name('admin.registerUsers');
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::get('appointments/{id}/edit', [AdminAppointmentController::class, 'edit'])->name('admin.appointments.edit');
    Route::put('appointments/{id}', [AdminAppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('appointments/{id}', [AdminAppointmentController::class, 'destroy'])->name('admin.appointments.destroy');



    // ------------------------------------
    // Admin Authenticated Routes (After Login)
    // ------------------------------------
    Route::middleware(['admin.auth'])->group(function () {

        // Admin Dashboard & Logout
        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminHomeController::class, 'logout'])->name('admin.logout');

        // Route for clearing cache
        Route::get('/clear-cache', [HomeController::class, 'clearCache'])->name('admin.clearCache');

       // ------------------------------------
        // Doctor Appoinment Management Routes
        // ------------------------------------
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('doctor-appointments', DoctorAppointmentController::class);
        });
         // Route to handle changing the status of a doctor appointment
         Route::post('doctor_appointments/change-status', [DoctorAppointmentController::class, 'changeStatus'])->name('doctor_appointments.changeStatus');	

        // ------------------------------------
        // User Management Routes
        // ------------------------------------
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{users}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{users}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/user/details/{id}', [UserController::class, 'show'])->name('user.details');

        // Admin routes For Broadcast
        Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
            Route::resource('broadcasts', BroadcastController::class);
        });
     
     // ------------------------------------
        // Feature Management Routes
        // ------------------------------------
        Route::prefix('admin')->group(function () {
            Route::resource('features', FeatureController::class)->names('admin.features');
        });
     // ------------------------------------
        // Feature Deteils Management Routes
        // ------------------------------------
        Route::prefix('admin')->group(function () {
            Route::resource('feature-detail-sections', FeatureDetailSectionController::class)->names('admin.feature-detail-sections');
        });	


        Route::get('aboutus', [AboutUsController::class, 'index'])->name('admin.aboutus.index');
        Route::get('aboutus/create', [AboutUsController::class, 'create'])->name('admin.aboutus.create');
        Route::post('aboutus', [AboutUsController::class, 'store'])->name('admin.aboutus.store');
        Route::get('aboutus/{aboutus}', [AboutUsController::class, 'show'])->name('admin.aboutus.show');
        Route::get('aboutus/{aboutus}/edit', [AboutUsController::class, 'edit'])->name('admin.aboutus.edit');
        Route::put('aboutus/{aboutus}', [AboutUsController::class, 'update'])->name('admin.aboutus.update');
        Route::delete('aboutus/{aboutus}', [AboutUsController::class, 'destroy'])->name('admin.aboutus.destroy');

        // ------------------------------------
        // Comapany Groth Routes
        // ------------------------------------
        Route::get('admin/company-Groth', [CompanyGrowthController::class, 'index'])->name('admin.company_growth.index');          // List all
        Route::get('admin/company_growth/create', [CompanyGrowthController::class, 'create'])->name('admin.company_growth.create');  // Show form
        Route::post('admin/company_growth', [CompanyGrowthController::class, 'store'])->name('admin.company_growth.store');         // Store new

        Route::get('admin/company_growth/{id}/edit', [CompanyGrowthController::class, 'edit'])->name('admin.company_growth.edit');   // Edit form
        Route::put('admin/company_growth/{id}', [CompanyGrowthController::class, 'update'])->name('admin.company_growth.update');    // Update
        Route::delete('admin/company_growth/{id}', [CompanyGrowthController::class, 'destroy'])->name('admin.company_growth.destroy'); // Delete





        // ------------------------------------
        // Authentication & Password Reset Routes
        // ------------------------------------
        Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('front.forgotPassword');
        Route::post('/process-forgot-password', [AuthController::class, 'processForgotPassword'])->name('front.processForgotPassword');
        Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('front.resetPassword');
        Route::post('/process-reset-password', [AuthController::class, 'processResetPassword'])->name('front.processResetPassword');


        // ------------------------------------
        // TicketFeature Routes
        // ------------------------------------
        Route::resource('ticket', TicketFeatureController::class)->names('admin.ticket');

        // ------------------------------------
        // WhatsApp Preview Routes
        // ------------------------------------
        Route::get('admin/admin-whatsapp-preview', [WhatsAppPreviewController::class, 'index'])->name('whatsapp-Main-preview');
        Route::post('whatsapp-preview', [WhatsAppPreviewController::class, 'update'])->name('whatsapp-preview.update');

        // ------------------------------------
        // WhatsappFlow Routes
        // ------------------------------------
        Route::prefix('admin')->group(function () {
            Route::get('whatsapp-flow', [WhatsappFlowController::class, 'edit'])->name('admin.whatsapp-flow.edit');
            Route::post('whatsapp-flow', [WhatsappFlowController::class, 'update'])->name('admin.whatsapp-flow.update');
        });

        // ------------------------------------
        // Service Detail Management Routes
        // ------------------------------------
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('service-detail-sections', ServiceDetailSectionsController::class)->names([
                'index' => 'service-detail-sections.index',
                'create' => 'service-detail-sections.create',
                'store' => 'service-detail-sections.store',
                'edit' => 'service-detail-sections.edit',
                'update' => 'service-detail-sections.update',
                'destroy' => 'service-detail-sections.destroy',
            ]);
        });

        // ------------------------------------
        // Themes Routes
        // ------------------------------------

        Route::get('/theme', [ThemeSectionController::class, 'index'])->name('admin.theme.index');
        Route::get('/create', [ThemeSectionController::class, 'create'])->name('admin.theme.create');
        Route::post('/store', [ThemeSectionController::class, 'store'])->name('admin.theme.store');
        Route::get('/edit/{section}', [ThemeSectionController::class, 'edit'])->name('admin.theme.edit');
        Route::put('/update/{section}', [ThemeSectionController::class, 'update'])->name('admin.theme.update');
        Route::delete('/delete/{id}', [ThemeSectionController::class, 'destroy'])->name('admin.theme.destroy');


        // ------------------------------------
        // Appoinment Routes
        // ------------------------------------
        Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');


        // ------------------------------------
        // Pages Routes
        // ------------------------------------
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{pages}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{pages}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{pages}', [PageController::class, 'destroy'])->name('pages.destroy');

        //Route for displaying the Why section
        Route::get('/why', [WhySectionController::class, 'index'])->name('admin.why.index');
        Route::get('/why/create', [WhySectionController::class, 'create'])->name('admin.why.create');
        Route::post('/why/store', [WhySectionController::class, 'store'])->name('admin.why.store');
        // ------------------------------------
        // Settings Routes
        // ------------------------------------
        // Setting Route.
        Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        // processChangePassword
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');
        // ------------------------------------
        // AppointmentController Route (For Whatsapp)
        // ------------------------------------
        // Optional: Name all routes clearly (for reference)
        Route::get('whatsapp', [AdminWhatsAppChatbotController::class, 'index'])->name('admin.whatsapp.index');
        Route::get('whatsapp/create', [AdminWhatsAppChatbotController::class, 'create'])->name('admin.whatsapp.create');
        Route::post('whatsapp', [AdminWhatsAppChatbotController::class, 'store'])->name('admin.whatsapp.store');
        Route::get('whatsapp/{id}/edit', [AdminWhatsAppChatbotController::class, 'edit'])->name('admin.whatsapp.edit');
        Route::put('whatsapp/{id}', [AdminWhatsAppChatbotController::class, 'update'])->name('admin.whatsapp.update');
        Route::delete('whatsapp/{id}', [AdminWhatsAppChatbotController::class, 'destroy'])->name('admin.whatsapp.destroy');

        // ------------------------------------
        // Chatbot Management Routes
        // ------------------------------------

        // Resourceful route for full CRUD
        // Route::resource('whatsapp', WhatsappChatbotController::class);

        // Optional: Name all routes clearly (for reference)
        Route::get('whatsapp', [AdminWhatsAppChatbotController::class, 'index'])->name('admin.whatsapp.index');
        Route::get('whatsapp/create', [AdminWhatsAppChatbotController::class, 'create'])->name('admin.whatsapp.create');
        Route::post('whatsapp', [AdminWhatsAppChatbotController::class, 'store'])->name('admin.whatsapp.store');
        Route::get('whatsapp/{id}/edit', [AdminWhatsAppChatbotController::class, 'edit'])->name('admin.whatsapp.edit');
        Route::put('whatsapp/{id}', [AdminWhatsAppChatbotController::class, 'update'])->name('admin.whatsapp.update');
        Route::delete('whatsapp/{id}', [AdminWhatsAppChatbotController::class, 'destroy'])->name('admin.whatsapp.destroy');



        // ------------------------------------
        // Temporary Image Upload Route
        // ------------------------------------


        // ------------------------------------
        // Profile Management Routes
        // ------------------------------------
        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');

    });



});
