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
Route::get('/subscribe', [
    'as' => 'subscribe',
    'uses' => 'MailchimpController@handle'
]);

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/home', [
    'as' => 'homeAuth',
    'uses' => 'HomeController@index'
]);

Auth::routes();

//Ajax for Dynamic DropDown

Route::get('unit/ajax/{id}',array('as'=>'myform.ajax','uses'=>'TaskController@unitAjax'));
Route::get('subunit/ajax/{id}',array('as'=>'myform.ajax','uses'=>'TaskController@subunitAjax'));

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


/**************************/
/*   Individual courses   */
/**************************/
Route::get('individual-courses', function() {
    return redirect()->route('domain.show', 'adobe-photoshop');
});

Route::get('individual-courses/{domainRoute}', [
    'as' => 'domain.show',
    'uses' => 'DomainController@show'
]);

Route::get('individual-courses/{domainRoute}/{courseRoute}', [
    'as' => 'course.show',
    'uses' => 'CourseController@show'
]);

Route::get('individual-courses/{domainRoute}/{courseRoute}/enroll', function() {
    return view('courses.individual_courses.payment_gateway');
});


/***************/
/*   User Profile   */
/***************/
Route::get('profile', function() {
    return view('pages.user.user_profile');
});
Route::post('updateProfile',[
    'as'=>'updateProfile',
    'uses'=>'UserController@updateProfile'
]);
Route::post('updatePassword',[
    'as'=>'updatePassword',
    'uses'=>'UserController@updatePassword'
]);
Route::delete('deleteAccount',[
    'as'=>'deleteAccount',
    'uses'=>'UserController@deleteAccount'
]);


/***********************/
/*   Content modules   */
/***********************/
    // Normal classes
Route::get('class/{id}', [
    'as' => 'class.show',
    'uses' => 'ClassesController@show'
]);

    // Virtual classes
Route::get('session/{id}', [
    'as' => 'session.show',
    'uses' => 'SessionController@show'
]);

    // Online lessons
Route::get('individual-courses/{domainRoute}/{courseRoute}/online', [
    'as' => 'lesson.index',
    'uses' => 'LessonController@index'
]);

Route::get('individual-courses/{domainRoute}/{courseRoute}/online/{lessonNo}', [
    'as' => 'lesson.show',
    'uses' => 'LessonController@show'
]);


Route::get('/file/{id}', [
    'as' => 'lesson.get_file',
    'uses' => 'LessonController@get_file'
]);

/*****************/
/*   Dashboard   */
/*****************/
Route::group(['prefix' => 'dashboard', 'middleware' => 'facultyAuth'], function () {

    Route::get('/', [
        'as' => 'dashboard.main',
        'uses' => 'DashboardController@index'
    ]);

    /***********************/
    /*   Lesson contents   */
    /***********************/
    Route::get('/lesson', [
        'as' => 'lesson.teacher_index',
        'uses' => 'LessonController@teacher_index'
    ]);
    Route::get('/lesson/{id}', [
        'as' => 'lesson.content_form',
        'uses' => 'LessonController@content_form'
    ]);

    Route::post('/lesson/{id}/update', [
        'as' => 'lesson.content_update',
        'uses' => 'LessonController@content_update'
    ]);

    

    /**************************/
    /*   Manager Middleware   */
    /**************************/
    /********************/
    /*   Manage Users   */
    /********************/
    Route::group(['middleware' => 'managerAuth'], function() {
        Route::get('user', [
            'as' => 'user.index',
            'uses' => 'UserController@index'
        ]);
        Route::get('user/{id}/edit', [
            'as' => 'user.edit',
            'uses' => 'UserController@edit'
        ]);
        Route::post('user/{id}', [
            'as' => 'user.update',
            'uses' => 'UserController@update'
        ]);
        Route::delete('user/{id}/delete', [
            'as' => 'user.delete',
            'uses' => 'UserController@destroy'
        ]);
    });


    /**************/
    /*   Courses  */
    /**************/
    Route::get('courses', [
        'as' => 'courses_tree',
        'uses' => 'DashboardController@courses_tree'
    ]);
    Route::get('course', [
        'as' => 'teacher.courses_tree',
        'uses' => 'DashboardController@teacher_courses_tree'
    ]);
        Route::group(['middleware' => 'managerAuth'], function() {
            /* Category */
            Route::get('category/create', [
                'as' => 'category.create',
                'uses' => 'CategoryController@create'
            ]);
            Route::post('category', [
                'as' => 'category.store',
                'uses' => 'CategoryController@store'
            ]);
            Route::get('category/{id}/edit', [
                'as' => 'category.edit',
                'uses' => 'CategoryController@edit'
            ]);
            Route::post('category/{id}', [
                'as' => 'category.update',
                'uses' => 'CategoryController@update'
            ]);
            Route::delete('category/{id}', [
                'as' => 'category.destroy',
                'uses' => 'CategoryController@destroy'
            ]);


            /* Domain */
            Route::get('domain/create', [
                'as' => 'domain.create',
                'uses' => 'DomainController@create'
            ]);
            Route::post('domain', [
                'as' => 'domain.store',
                'uses' => 'DomainController@store'
            ]);
            Route::get('domain/{id}/edit', [
                'as' => 'domain.edit', 
                'uses' => 'DomainController@edit'
            ]);
            Route::post('domain/{id}', [
                'as' => 'domain.update',
                'uses' => 'DomainController@update'
            ]);
            Route::delete('domain/{id}', [
                'as' => 'domain.destroy', 
                'uses' => 'DomainController@destroy'
            ]);


            /* Course */
            Route::get('course/create', [
                'as' => 'course.create',
                'uses' => 'CourseController@create'
            ]);
            Route::post('course', [
                'as' => 'course.store',
                'uses' => 'CourseController@store'
            ]);
            Route::get('course/{id}/edit', [
                'as' => 'course.edit',
                'uses' => 'CourseController@edit'
            ]);
            Route::post('course/{id}', [
                'as' => 'course.update',
                'uses' => 'CourseController@update'
            ]);
            Route::delete('course{id}', [
                'as' => 'course.destroy',
                'uses' => 'CourseController@destroy'
            ]);
            Route::get('new-course',[
                'as' => 'dashboard.newcourse',
                'uses' =>'CourseController@course_status'
                ]);
            Route::get('course/add/{id}',[
                'as' => 'course.add',
                'uses' =>'CourseController@course_add'
                ]);
            Route::get('course/delete/{id}',[
                'as' => 'course.delete',
                'uses' =>'CourseController@course_delete'
                ]);
        });

    /********************/
    /*   Course panels  */
    /********************/
    Route::group(['middleware' => 'managerAuth'], function() {
        Route::get('panels/create', [
            'as' => 'coursePanel.create',
            'uses' => 'CourseController@coursePanel_create'
        ]);

        Route::post('panels/create', [
            'as' => 'coursePanel.store',
            'uses' => 'CourseController@coursePanel_store'
        ]);

        Route::post('panels/{id}', [
            'as' => 'coursePanel.destroy',
            'uses' => 'CourseController@coursePanel_destroy'
        ]);
    });

 /********************/
 /*Trainer Assignment */
 /********************/
     Route::get('assign-traier/', [
            'as' => 'assign.index',
            'uses' => 'TaskController@index'
        ]);
     Route::post('assign-traier/store', [
            'as' => 'assign.trainer.store',
            'uses' => 'TaskController@assignTrainerStore'
        ]);
     Route::get('assign-traier/index', [
            'as' => 'assigned.trainer.index',
            'uses' => 'TaskController@assignedTrainerIndex'
        ]);
      Route::delete('assigned-traier/delete/{id}', [
            'as' => 'assigned.trainer.delete',
            'uses' => 'TaskController@assignedTrainerDelete'
        ]);

    /*****************************/
    /*   Course framework units  */
    /*****************************/
    Route::group(['middleware' => 'managerAuth'], function() {
        Route::post('framework-unit/{id}/create', [
            'as' => 'courseFrameworkUnit.store',
            'uses' => 'CourseFrameworkUnitController@store'
        ]);

        Route::get('framework-unit/{id}/edit', [
            'as' => 'courseFrameworkUnit.edit',
            'uses' => 'CourseFrameworkUnitController@edit'
        ]);

        Route::post('framework-unit/{id}/edit', [
            'as' => 'courseFrameworkUnit.update',
            'uses' => 'CourseFrameworkUnitController@update'
        ]);

        Route::delete('framework-unit/{id}', [
            'as' => 'courseFrameworkUnit.destroy',
            'uses' => 'CourseFrameworkUnitController@destroy'
        ]);
    });


    /********************************/
    /*   Course framework subunits  */
    /********************************/
    Route::group(['middleware' => 'managerAuth'], function() {
        Route::get('framework-unit/{unitid}/{coursePattern}/create-sub', [
            'as' => 'courseFrameworkSubunit.create',
            'uses' => 'CourseFrameworkSubunitController@create'
        ]);

        Route::post('framework-unit/{id}/create-sub/', [
            'as' => 'courseFrameworkSubunit.store',
            'uses' => 'CourseFrameworkSubunitController@store'
        ]);

        Route::get('framework-subunit/{subunitId}/edit', [
            'as' => 'courseFrameworkSubunit.edit',
            'uses' => 'CourseFrameworkSubunitController@edit'
        ]);

        Route::post('framework-subunit/{id}/edit', [
            'as' => 'courseFrameworkSubunit.update',
            'uses' => 'CourseFrameworkSubunitController@update'
        ]);

        Route::delete('framework-subunit/{id}', [
            'as' => 'courseFrameworkSubunit.destroy',
            'uses' => 'CourseFrameworkSubunitController@destroy'
        ]);

        Route::get('framework-subunit/{id}', [
            'as' => 'courseFrameworkSubunit.destroy',
            'uses' => 'CourseFrameworkSubunitController@destroy'
        ]);
    });

  //submodule

    Route::get('framework-module/{unitid}/{courseId}/create-sub', [
            'as' => 'courseFrameworkSubmodule.create',
            'uses' => 'CourseFrameworkSubunitController@moduleCreate'
        ]);

    Route::Post('framework-module/{unitid}/create-sub', [
            'as' => 'courseFrameworkSubmodule.store',
            'uses' => 'CourseFrameworkSubunitController@moduleStore'
        ]);


    /**************/
    /*   Classes  */
    /**************/
    Route::group(['middleware' => 'managerAuth'], function() {
        Route::get('class', [
            'as' => 'class.index',
            'uses' => 'ClassesController@index'
        ]);
  
    //Online Class 

        Route::get('online-class/create', [
            'as' => 'online.class.create',
            'uses' => 'ClassesController@onlineClassCreate'
        ]);

        Route::post('online-class/create', [
            'as' => 'online.class.store',
            'uses' => 'ClassesController@onlineClassStore'
        ]);

        Route::get('online-class/{id}/edit', [
            'as' => 'online.class.edit',
            'uses' => 'ClassesController@onlineClassEdit'
        ]);

        Route::delete('online-class/{id}/destroy', [
            'as' => 'online.class.destroy',
            'uses' => 'ClassesController@onlineClassDestroy'
        ]);

        Route::post('online-class/{id}/update', [
            'as' => 'online.class.update',
            'uses' => 'ClassesController@onlineClassUpdate'
        ]);

    //Virtual Class

        Route::get('virtual-class/create', [
            'as' => 'virtual.class.create',
            'uses' => 'ClassesController@virtualClassCreate'
        ]);

        Route::post('virtual-class/create', [
            'as' => 'virtual.class.store',
            'uses' => 'ClassesController@virtualClassStore'
        ]);

         Route::get('virtual-class/{id}/edit', [
            'as' => 'virtual.class.edit',
            'uses' => 'ClassesController@virtualClassEdit'
        ]);

        Route::delete('virtual-class/{id}/destroy', [
            'as' => 'virtual.class.destroy',
            'uses' => 'ClassesController@virtualClassDestroy'
        ]);
        Route::post('virtual-class/{id}/update', [
            'as' => 'virtual.class.update',
            'uses' => 'ClassesController@VirtualClassUpdate'
        ]);

        //Normal Class 
        Route::get('class/create', [
            'as' => 'class.create',
            'uses' => 'ClassesController@create'
        ]);

        Route::post('class/create', [
            'as' => 'class.store',
            'uses' => 'ClassesController@store'
        ]);

        Route::get('class/{id}/edit', [
            'as' => 'class.edit',
            'uses' => 'ClassesController@edit'
        ]);

        Route::post('class/{id}', [
            'as' => 'class.update',
            'uses' => 'ClassesController@update'
        ]);

        Route::delete('class/{id}', [
            'as' => 'class.destroy',
            'uses' => 'ClassesController@destroy'
        ]);

    });


    /***************/
    /*   Sessions  */
    /***************/
    Route::get('session/create', [
        'as' => 'session.create',
        'uses' => 'SessionController@create'
    ]);

    Route::post('session/create', [
        'as' => 'session.store',
        'uses' => 'SessionController@store'
    ]);

    Route::get('session/{id}/edit', [
        'as' => 'session.edit',
        'uses' => 'SessionController@edit'
    ]);

    Route::post('session/{id}', [
        'as' => 'session.update',
        'uses' => 'SessionController@update'
    ]);

    Route::delete('session/{id}', [
        'as' => 'session.destroy',
        'uses' => 'SessionController@destroy'
    ]);



    /********************/
    /*   Online/Lesson  */
    /********************/
    Route::group(['middleware' => 'managerAuth'], function() {
        Route::get('/online-course/{courseId}', [
            'as' => 'lesson.manager_index',
            'uses' => 'LessonController@manager_index'
        ]);
        Route::get('/lesson-create/', [
            'as' => 'lesson.create',
            'uses' => 'LessonController@create'
        ]);

        Route::post('lesson/create', [
            'as' => 'lesson.store',
            'uses' => 'LessonController@store'
        ]);

        Route::get('lesson/{id}/edit', [
            'as' => 'lesson.edit',
            'uses' => 'LessonController@edit'
        ]);

        Route::post('lesson/{id}', [
            'as' => 'lesson.update',
            'uses' => 'LessonController@update'
        ]);

        Route::delete('lesson/{id}', [
            'as' => 'lesson.destroy',
            'uses' => 'LessonController@destroy'
        ]);
    });
});
Route::get('/payment', function () {
    return view('payment');
});
  