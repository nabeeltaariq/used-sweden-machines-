<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\Illuminate\Support\Facades\Route::get('/', 'Home@Main');
Route::get('/policy', 'Home@privacyPolicy');
Route::post('send', 'Home@sendmail');
Route::get('email', 'Home@email');
Route::get('{mahcine_name}/{id}', "Products@machine");
Route::get('{mahcine_name}/{id}/next', "Products@machine");
Route::get('{mahcine_name}/{id}/next/mobile', "Products@machineMobile");
Route::get('{mahcine_name}/{id}/pre/mobile', "Products@machineMobile");


Route::get("/refurbished_tetra_pak_machines_supplier_home", "Home@Index");
Route::post("/refurbished_tetra_pak_machines_supplier_home", "Home@AddSubscriber");


Route::get('category/selected/all', 'Home@all');
Route::get('category/selected/{cat_id}', 'Home@fetchFewMachines');
Route::get('/auth', 'SameelController@showAuthPage');
Route::post("/auth", "SameelController@ProcessLogin");
Route::get("/processOrder", "SameelController@ProcessOrder");
Route::post("/createProfile", "SameelController@CreateProfile");
Route::any("/submitinfo/{id}", "SameelController@PushInfo");
Route::get("/checkout", "SameelController@Checkout");


Route::get("tetra-pak-machines-expert", "Home@About");
Route::get("Technical-services", "Home@TechnicalServices");

Route::get("purchase", "Home@purchase");
Route::get("used-tetra-pak-machines", "Home@AllMachines");
Route::get("all-spare-parts", "Home@DisplaySpareParts");
Route::get('news', "Home@FetchNews");
Route::post('news', "Home@SubscriptionWithNews");
Route::get('contact', "Home@ContactForm");
Route::POST('contact', "Home@ContactFormSubmit")->name('ContactFormSubmit');
Route::GET('contact/mobile', "Home@ContactFormSubmitFromMobile")->name('ContactFormSubmitFromMobile');
Route::get("tetra-pak-spare-parts", "Home@SpareParts");
Route::get("news/by/{id}", "Home@FetchNewsById");
Route::get('admin', "Admin@Index");
Route::post('admin', "Admin@ProcessRequest");
Route::get('logout', "Admin@Logout");
Route::get("upload-your-machine", "Home@purchase");
Route::post("upload-your-machine", "Home@purchaseForm");

Route::get("cart", "Home@DisplayCart");
Route::get("/news/event/{id}", "Home@SingleEvent");
Route::get("/news/newsletter/{id}", "Home@SingleNewsLetter");
Route::get("/machine/{id}", "Home@QuoteForm")->name('QuoteFormView');
Route::POST("/machine/contactUsform", "Home@QuoteFormContactUs")->name('QuoteFormView');
Route::get("/machineView/{id}", "Home@MachineViewFromSharing");
Route::POST("/machine/{id}", "Home@QuoteFormSubmit")->name('QuoteFormSubmit');
Route::get("/machine-pdf/generate/{id}", "Home@GeneratePdf");
Route::get("/machine-pdf-news/generate/{id}", "Home@GeneratePdfNews");
Route::get("/spare-parts/categories/{id}", "Home@ShowSparePartCategories");
Route::view("forget-password", "auth.forgetpasswordpage");
Route::post("forget-password", "SameelController@ForgetPassword");
Route::get("international-projects", function () {
    return view("map");
});
//routes for machines
Route::get("/{id?}", "Home@FetchMachine");


// Route::get("admin/logout", "Admin@Logout");
//admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'Auth'], function () {
    Route::get("all/products", "Products@Index");
    Route::get("/backupdb", "Admin@MakeBackupDb");
    Route::get("/products/view/{id}", "Products@viewProduct");
    Route::POST("/products/view/{id}", "Products@sendMailOfProduct")->name('sendMailOfProduct');
    Route::get("/products/send/to/Multiple/{id}", "Products@sendToMultipleView")->name('sendToMultipleView');
    Route::post("/products/send/to/Multiple/{id}", "Products@SendMultipleEmail");

    Route::get("/changePassword", "Admin@ChangePassword");
    Route::post("/changePassword", "Admin@SavePassword");
    Route::get("/userManagement", "Admin@userManagement");
    Route::get("/addNewUser", "Admin@newUserForm");
    Route::post("/addNewUser", "Admin@addNewUser");
    Route::get("/editUser/{uId}", "Admin@editUserForm");
    Route::post("/editUser/{uId}", "Admin@updateUser");
    Route::get("/getPages", "Admin@getPages");
    Route::post("/removeUser/{uId}", "Admin@removeUser");


    //products routing
    Route::group(['prefix' => 'products'], function () {
        Route::get("/new", "Products@AddProductForm");
        Route::get("/uploadedProducts", "Products@ViewUploads");
        Route::get("/deleteUploadedProducts", "Products@DeleteUploads");
        Route::get("/uploaded-products/view/{id}", "Products@ViewUploadedProduct");


        Route::get("/catagories", "Catagory@Index");
        Route::get("/manage-products", "Products@Index");

        Route::get("/addCategory", "Catagory@AddNew");
        Route::post("/addCategory", "Catagory@Save");
        Route::get("/categories/remove/{id}", "Catagory@Remove");
        Route::get("/categories/edit/{id}", "Catagory@EditForm");
        Route::post("/categories/edit/{id}", "Catagory@SaveChanges");
        Route::get("/new", "Products@AddProductForm");
        Route::post("/new", "Products@Save");
        Route::get("/remove/{id}", "Products@Remove");
        Route::get("/edit/{id}", "Products@EditForm");
        Route::delete("/edit/{id}", "Products@DeleteImages");
        Route::post("/saveChanges", "Products@SaveChanges");
        Route::get("/saveChanges", "Products@Index");
        Route::get("/stockReport", "Products@ShowReportPerforma");
        Route::get("/stockReport", "Products@GenerateReport");
    });
    //pages routing
    Route::get("/pages", "Pages@Index");
    Route::get("/pages/edit/{id}", "Pages@EditForm");
    Route::post("/pages/edit/{id}", "Pages@SaveChanges");

    //news routing
    Route::get('/get/news', "NewsController@Index");
    //news grouping
    Route::group(['prefix' => 'news'], function () {
        Route::get("/new", "NewsController@New");
        Route::post("/new", "NewsController@Save");
        Route::get("/remove/{id}", "NewsController@RemoveNews");
        Route::get("/edit/{id}", "NewsController@EditNews");
        Route::post("/edit/{id}", "NewsController@SaveChanges");
        Route::post("removeImages", "NewsController@DeleteImages");
        Route::get("/references", "References@Index");
        Route::group(['prefix' => '/references'], function () {
            Route::get("/new", "References@New");
            Route::post("/new", "References@Save");
            Route::get("/edit/{id}", "References@EditForm");
            Route::post("/edit/{id}", "References@SaveChanges");
            Route::get("/delete/{id}", "References@RemoveReference");
        });

        Route::get("/testimonials", "Testimonials@Index");
        Route::group(['prefix' => '/testimonials'], function () {
            Route::get('new', "Testimonials@AddForm");
            Route::post('new', "Testimonials@Save");
            Route::get("/edit/{id}", "Testimonials@EditForm");
            Route::post("/edit/{id}", "Testimonials@SaveChanges");
            Route::get("remove/{id}", "Testimonials@Remove");
        });

        Route::group(['prefix' => '/events'], function () {
            Route::get("/browse", "Events@AllEvents");
            Route::get("/new", "Events@new");
            Route::post("/new", "Events@Save");
            Route::get("/remove/{id}", "Events@Remove");
            Route::get("/edit/{id}", "Events@Edit");
            Route::delete("/edit/{id}", "Events@DeletePictures");
            Route::post("/edit/{id}", "Events@SaveChanges");
        });
    });

    //SpareParts routing
    Route::get("/all/spareParts", "SpareParts@Index");
    Route::group(['prefix' => '/spareParts'], function () {
        Route::get("/home", "SpareParts@Home");
        Route::get("machines/new", "SpareParts@MachineForm");
        Route::post("machines/new", "SpareParts@saveMachine");
        Route::get("machines/{id}/edit", "SpareParts@editMachine");
        Route::post("machines/{id}/update", "SpareParts@updateMachine");
        Route::get("/categories", "SpareParts@CatgoryForm");
        Route::get("/categories/new", "SpareParts@NewCategoryForm");
        Route::post("/categories/new/store", "SpareParts@AddCategory");
        Route::get("/categories/{id}/edit", "SpareParts@editCategoryForm");
        Route::post("/categories/{id}/update", "SpareParts@updateCategory");
        Route::get("/sub-categories/{parent_id}", "SpareParts@SubCatHome");
        Route::get("/sub-categories/add/new", "SpareParts@NewSubCatForm");
        Route::post("/sub-categories/add/new/store", "SpareParts@StoreSubCat");
        Route::get("/sub-categories/{id}/edit", "SpareParts@editSubCat");
        Route::post("/sub-categories/{id}/update", "SpareParts@updateSubCat");
        Route::get("/new", "SpareParts@newForm");
        Route::post("/new/store", "SpareParts@storeSparePart");
        Route::get("/{id}/edit", "SpareParts@editSparePartForm");
        Route::post("/{id}/update", "SpareParts@updateSparePart");
        Route::get("/{id}/delete", "SpareParts@deleteSparePart");
        Route::get("/import/data", "SpareParts@importView");
        Route::post("/import/data", "SpareParts@importProcessData");
    });

    Route::get("/fetch/contacts", "Contacts@Index");
    Route::group(['prefix' => '/contacts'], function () {
        Route::get("/head", "Contacts@Head");
        Route::post("/head", "Contacts@SaveHead");
        Route::post("/editHead", "Contacts@EditHead");
        Route::get("/edit/{id}", "Contacts@EditContactForm");
        Route::get("/subscribers", "Contacts@Subscribers");
        Route::get("/deleteSubscriber/{id}", "Contacts@RemoveSubscriber");
        Route::get("/subscribers/edit/{id}", "Contacts@SubscriberEditForm");
        Route::post("/subscribers/edit/{id}", "Contacts@SaveSubscriberChanges");
        Route::get("/find", "Contacts@ShowAllContacts")->name("allContacts");
        Route::get("/find/{id}", "Contacts@ShowSingleContacts");
        Route::get("/singleContact/{id}", "Contacts@SingleContact");
        Route::get("/deleteEngineer", "Contacts@DeleteEngineer");
        Route::get("/editEngineer/{id}", "Contacts@EditEngineer");
        Route::get("/viewEngineer/{id}", "Contacts@ViewEngineer");

        Route::post("/updateEngineer", "Contacts@UpdateEngineer");

        Route::get("/designations", "Contacts@Designations");
        Route::get("/services", "Contacts@Services");
        Route::post("/services", "Contacts@SaveSearch");
        Route::get("/redirectToContact/{udId}/{typeId}", "Contacts@RedirectToContact");
        Route::get('/services/single/{id}', "Contacts@SingleService");
        Route::get("/services/edit/{id}", "Contacts@ServiceEditForm");
        Route::post("/designations", "Contacts@AddDesignation");
        Route::post("/designations/update", "Contacts@UpdateDesignation");
        Route::get("/new", "Contacts@New");
        Route::get("/countries", "Contacts@Countries");
        Route::post("/countries", "Contacts@SaveCountry");
        Route::get("/countries/edit/{id}", "Contacts@EditCountryForm");
        Route::post("/countries/edit/{id}", "Contacts@CountrySaveChanges");
        //routing for api
        Route::get("/getContacts/{id}", "Contacts@FetchContacts");
        Route::get("/AllContactHeads", "Contacts@AllContactHeads");
    });
});






//api routes
Route::group(['prefix' => 'api'], function () {
    Route::get('updated/all-machines', "API@allMachinesApi");
    Route::post('/fetchMachines/{id?}', "API@FetchMachines");
    Route::get("/fillCart/now", "API@Fill");
    Route::post("/UpdateService", "API@UpateService");
    Route::get("/getContactType", "API@FetchContactType");
    Route::POST("/GETContactNewId", "API@ProcessContact");
    Route::get("/getservices", "API@getservices");
    Route::post("/UploadServicePicture", "API@UploadServicePicture");
    Route::get("getPartsCategories/{id}", "API@PartsCategories");
    Route::get("getSubCategory/{id}", "API@SubCategories");

    //Sameel Start

    Route::get("/updateCart", "SameelController@updateCart");
    Route::get("/item/deleteFromCart", "SameelController@removeItem");
    Route::get("/item/cartUpdate", "SameelController@cartUpdate");
    Route::get('/updated/welcome-page', 'API@welcome_page_data_api');
    Route::post('/updated/add-subscriber', 'API@AddSubscriber');
    Route::get('/updated/get-all-machines-categories', 'API@AllMachinesCategories');
    Route::get('/updated/more-detail/{mahineid}', 'API@MoreDetail');
    Route::get('select/all/catgories', 'API@fetchAllMachinesCategories');
    Route::get('select/category', 'API@fetchFewMachines');
    Route::get('/updated/machine-pdf/generate/{id}', 'API@GeneratePdf');
    Route::get('/machine-pdf-news/generate/{id}', 'API@GenerateNewsPdf');
    Route::get('/updated/all-spare-parts-api', 'API@DisplaySpareParts');
    Route::post('/updated/upload-your-machine', 'API@uploadYourMachine');
    Route::get('/updated/checkout', 'API@Checkout');


    Route::get('/updated/get-news-newsletters-testimonials', 'API@FetchNewsAndNewsletter');
    Route::post('/updated/news-page-subscription', 'API@AddSubscriber');
    Route::post('/updated/auth', 'API@ProcessLogin');
    Route::post('/updated/create-profile', 'API@CreateProfile');
    Route::post('/updated/delivery-info-of-user', 'API@DeliveryInfo');
    Route::post("/updated/machine/contactUsform", "API@QuoteFormContactUs");
    Route::post("/updated/forget-password", "API@ForgetPassword");
    Route::post("/updated/price-details", "API@QuoteFormSubmit");

    //sameel end
});

Route::get('clear-cache', function () {
    \Artisan::call('optimize:clear');
    return back();
});
