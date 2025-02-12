<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions FOR ADMIN
 * --------------------------------------------------------------------
 */


// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->add('/', 'Home::index');
// $routes->add('/', 'PkUser/Home::index');
// $routes->add('user/(:any)', 'PkUser/Home::index');
// $routes->add('Home', 'PkUser/Home::index');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'CttAdmin/Home::is_login');
$routes->add('ctt-admin', 'CttAdmin/Home::is_login');
$routes->add('ctt-admin/dashboard', 'CttAdmin/Home::index');
$routes->add('ctt-admin/login', 'CttAdmin/Home::is_login');
$routes->add('ctt-admin/signout', 'CttAdmin/Home::signout');
$routes->add('ctt-admin/change-password', 'CttAdmin/Home::changepassword');
$routes->add('ctt-admin/forgot-password', 'CttAdmin/Home::forgetpassword');
$routes->add('ctt-admin/reset-password/(:any)', 'CttAdmin/Home::resetpassword');

$routes->add('ctt-admin/create-password/(:any)', 'CttAdmin/Home::resetpassword');
$routes->add('ctt-admin/register', 'CttAdmin/Home::registerkeymanager');

//Routes For Parameter
$routes->add('ctt-admin/parameter-listing', 'CttAdmin/Parameter::parameterlisting');
$routes->add('ctt-admin/add-parameter', 'CttAdmin/Parameter::addparameter');
$routes->add('ctt-admin/edit-parameter/(:any)', 'CttAdmin/Parameter::editparameter');

//Routes For Setting
$routes->add('ctt-admin/setting-listing', 'CttAdmin/Setting::settinglisting');
$routes->add('ctt-admin/add-setting', 'CttAdmin/Setting::addsetting');
$routes->add('ctt-admin/edit-setting/(:any)', 'CttAdmin/Setting::editsetting');

//Routes For industry
$routes->add('ctt-admin/industry-listing', 'CttAdmin/Industry::industrylisting');
$routes->add('ctt-admin/add-industry', 'CttAdmin/Industry::addindustry');
$routes->add('ctt-admin/search-industry', 'CttAdmin/Industry::searchindustry');
$routes->add('ctt-admin/edit-industry/(:any)', 'CttAdmin/Industry::editindustry');
$routes->add('ctt-admin/delete-industry/(:any)', 'CttAdmin/Industry::deleteindustry');
$routes->add('ctt-admin/inactive-industry/(:any)', 'CttAdmin/Industry::inactiveindustry');
$routes->add('ctt-admin/active-industry/(:any)', 'CttAdmin/Industry::activeindustry');

//Routes For organisation
$routes->add('ctt-admin/organisation-listing', 'CttAdmin/Organisation::organisationlisting');
$routes->add('ctt-admin/add-organisation', 'CttAdmin/Organisation::addorganisation');
$routes->add('ctt-admin/search-organisation', 'CttAdmin/Organisation::searchorganisation');
$routes->add('ctt-admin/edit-organisation/(:any)', 'CttAdmin/Organisation::editorganisation');
$routes->add('ctt-admin/delete-organisation/(:any)', 'CttAdmin/Organisation::deleteorganisation');
$routes->add('ctt-admin/delete-organisation-image', 'CttAdmin/Organisation::deleteimage');
$routes->add('ctt-admin/inactive-organisation/(:any)', 'CttAdmin/Organisation::inactiveorganisation');
$routes->add('ctt-admin/active-organisation/(:any)', 'CttAdmin/Organisation::activeorganisation');

//Routes For sbu
$routes->add('ctt-admin/sbu-listing', 'CttAdmin/Sbu::sbulisting');
$routes->add('ctt-admin/add-sbu', 'CttAdmin/Sbu::addsbu');
$routes->add('ctt-admin/search-sbu', 'CttAdmin/Sbu::searchsbu');
$routes->add('ctt-admin/edit-sbu/(:any)', 'CttAdmin/Sbu::editsbu');
$routes->add('ctt-admin/delete-sbu/(:any)', 'CttAdmin/Sbu::deletesbu');
$routes->add('ctt-admin/inactive-sbu/(:any)', 'CttAdmin/Sbu::inactivesbu');
$routes->add('ctt-admin/active-sbu/(:any)', 'CttAdmin/Sbu::activesbu');
$routes->add('ctt-admin/delete-vendor-master', 'CttAdmin/Sbu::DeleteVendorMaster');
$routes->add('ctt-admin/delete-employee-master', 'CttAdmin/Sbu::DeleteEmployeeMaster');

//Routes For department
$routes->add('ctt-admin/department-listing', 'CttAdmin/Department::departmentlisting');
$routes->add('ctt-admin/add-department', 'CttAdmin/Department::adddepartment');
$routes->add('ctt-admin/search-department', 'CttAdmin/Department::searchdepartment');
$routes->add('ctt-admin/edit-department/(:any)', 'CttAdmin/Department::editdepartment');
$routes->add('ctt-admin/delete-department/(:any)', 'CttAdmin/Department::deletedepartment');
$routes->add('ctt-admin/inactive-department/(:any)', 'CttAdmin/Department::inactivedepartment');
$routes->add('ctt-admin/active-department/(:any)', 'CttAdmin/Department::activedepartment');

//Routes For contract
$routes->add('ctt-admin/contract-listing', 'CttAdmin/Contract::contractlisting');
$routes->add('ctt-admin/add-contract', 'CttAdmin/Contract::addcontract');
$routes->add('ctt-admin/search-contract', 'CttAdmin/Contract::searchcontract');
$routes->add('ctt-admin/edit-contract/(:any)', 'CttAdmin/Contract::editcontract');
$routes->add('ctt-admin/delete-contract/(:any)', 'CttAdmin/Contract::deletecontract');
$routes->add('ctt-admin/inactive-contract/(:any)', 'CttAdmin/Contract::inactivecontract');
$routes->add('ctt-admin/active-contract/(:any)', 'CttAdmin/Contract::activecontract');

//Routes For Vendor
$routes->add('ctt-admin/vendor-listing', 'CttAdmin/Vendor::vendorlisting');
$routes->add('ctt-admin/add-vendor', 'CttAdmin/Vendor::addvendor');
$routes->add('ctt-admin/search-vendor', 'CttAdmin/Vendor::searchvendor');
$routes->add('ctt-admin/edit-vendor/(:any)', 'CttAdmin/Vendor::editvendor');
$routes->add('ctt-admin/view-vendor/(:any)', 'CttAdmin/Vendor::viewvendor');
$routes->add('ctt-admin/delete-vendor/(:any)', 'CttAdmin/Vendor::deletevendor');
$routes->add('ctt-admin/delete-company-logo', 'CttAdmin/Vendor::DeleteCompanyLogo');
$routes->add('ctt-admin/delete-company-cin', 'CttAdmin/Vendor::DeleteCompanyCin');
$routes->add('ctt-admin/delete-company-gst', 'CttAdmin/Vendor::DeleteCompanyGst');
$routes->add('ctt-admin/delete-company-turn-over-one', 'CttAdmin/Vendor::DeleteCompanyTurnOverOne');
$routes->add('ctt-admin/delete-company-turn-over-two', 'CttAdmin/Vendor::DeleteCompanyTurnOverTwo');
$routes->add('ctt-admin/delete-company-turn-over-three', 'CttAdmin/Vendor::DeleteCompanyTurnOverThree');


//Routes For employee
$routes->add('ctt-admin/employee-listing', 'CttAdmin/Employee::employeelisting');
$routes->add('ctt-admin/add-employee', 'CttAdmin/Employee::addemployee');
$routes->add('ctt-admin/employeerole-listing', 'CttAdmin/Employee::employeerolelisting');
$routes->add('ctt-admin/employee/getsbu', 'CttAdmin/Employee::getsbu');
$routes->add('ctt-admin/search-employee', 'CttAdmin/Employee::searchemployee');
$routes->add('ctt-admin/edit-employee/(:any)', 'CttAdmin/Employee::editemployee');
$routes->add('ctt-admin/search-employee-role', 'CttAdmin/Employee::searchemployeerole');
$routes->add('ctt-admin/employee/getdepartment', 'CttAdmin/Employee::getdepartment');

//Routes For Key Manager
$routes->add('ctt-admin/key-manager-listing', 'CttAdmin/KeyManager::keymanagerlisting');
$routes->add('ctt-admin/add-key-manager', 'CttAdmin/KeyManager::addkeymanager');
$routes->add('ctt-admin/search-key-manager', 'CttAdmin/KeyManager::searchkeymanager');
$routes->add('ctt-admin/edit-key-manager/(:any)', 'CttAdmin/KeyManager::editkeymanager');
$routes->add('ctt-admin/delete-key-manager/(:any)', 'CttAdmin/KeyManager::deletekeymanager');
$routes->add('ctt-admin/inactive-key-manager/(:any)', 'CttAdmin/KeyManager::inactivekeymanager');
$routes->add('ctt-admin/active-key-manager/(:any)', 'CttAdmin/KeyManager::activekeymanager');



//Routes For Evaluation
$routes->add('ctt-admin/evaluation-questions-listing', 'CttAdmin/EvaluationQuestions::evaluationquestionslisting');
$routes->add('ctt-admin/add-evaluation-questions', 'CttAdmin/EvaluationQuestions::addevaluationquestions');
$routes->add('ctt-admin/edit-evaluation-questions/(:any)', 'CttAdmin/EvaluationQuestions::editevaluationquestions');
$routes->add('ctt-admin/delete-evaluation-questions/(:any)', 'CttAdmin/EvaluationQuestions::deleteevaluationquestions');
$routes->add('ctt-admin/search-evaluation-questions', 'CttAdmin/EvaluationQuestions::searchevaluationquestions');

//Routes For Vendor Payment
$routes->add('ctt-admin/vendorpayment/(:any)', 'CttAdmin/VendorPayment::vendorpayment');

$routes->add('ctt-admin/payment/success/(:any)', 'CttAdmin/VendorPayment::success');
$routes->add('ctt-admin/payment/fail/(:any)', 'CttAdmin/VendorPayment::failure');


//Routes For Link Up
$routes->add('ctt-admin/assign-vendor-listing', 'CttAdmin/AssignVendor::assignvendorlisting');
$routes->add('ctt-admin/add-assign-vendor', 'CttAdmin/AssignVendor::addassignvendor');
$routes->add('ctt-admin/search-assign-vendor', 'CttAdmin/AssignVendor::searchassignvendor');
$routes->add('ctt-admin/edit-assign-vendor/(:any)', 'CttAdmin/AssignVendor::editassignvendor');
$routes->add('ctt-admin/delete-assign-vendor/(:any)', 'CttAdmin/AssignVendor::deleteassignvendor');
$routes->add('ctt-admin/inactive-assign-vendor/(:any)', 'CttAdmin/AssignVendor::inactiveassignvendor');
$routes->add('ctt-admin/active-assign-vendor/(:any)', 'CttAdmin/AssignVendor::activeassignvendor');
$routes->add('ctt-admin/delete-vendor-master', 'CttAdmin/AssignVendor::DeleteVendorMaster');
$routes->add('ctt-admin/delete-employee-master', 'CttAdmin/AssignVendor::DeleteEmployeeMaster');
/**
 * --------------------------------------------------------------------
 * Route Definitions FOR User
 * --------------------------------------------------------------------
 */
 
 
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
