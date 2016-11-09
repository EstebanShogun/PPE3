<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \Slim\Slim();

use RedBeanPHP\R;

R::setup('mysql:host=localhost;
        dbname=PPE_GSB_v0', 'root', 'pwsio');

// SELECT
// visitors
$app->get('/visitor/', function () {
    
        echo json_encode(R::findAll('visitor'));
    
});

$app->get('/visitor/:id/', function ($id) {
    
        echo json_encode(R::load('visitor', $id));   
});

//report de visite
$app->get('/report/', function () {
    
        echo json_encode(R::findAll('visiteReport'));
    
});

$app->get('/report/:id/', function ($id) {
    
        echo json_encode(R::load('visiteReport', $id));   
});

$app->get('/report/visitor/:idVisitor/', function ($idVisitor) {
    
        echo json_encode(R::find('visiteReport', 'visitor_id ='.$idVisitor));   
});

$app->get('/report/practicien/:idPracticien/', function ($idPracticien) {
    
        echo json_encode(R::find('visiteReport', 'practicien_id ='.$idPracticien));   
});

$app->get('/report/visitor/practicien/:idVisitor/:idPracticien/', function ($idVisitor,$idPracticien) {
    
        echo json_encode(R::find('visiteReport', 'practicien_id ='.$idPracticien , 'visitor_id ='.$idVisitor ));   
});

//Activité compémentaire 

$app->get('/additonalActivity/', function () {
    
        echo json_encode(R::findAll('additonalActivity'));
    
});

$app->get('/additonalActivity/:id/', function ($id) {
    
        echo json_encode(R::load('additonalActivity',$id));
    
});

$app->get('/additonalActivity/visitor/:idVisitor/', function ($idVisitor) {
    
        echo json_encode(R::find('additonalActivity', 'visitor_id ='.$idVisitor));
});

$app->get('/additonalActivity/practicionner/:idPracticien/', function ($idPracticien) {
    
        echo json_encode(R::find('additonalActivity', 'practicien_id ='.$idPracticien));
});

// Journées travaillées

$app->get('/work/', function () {
    
        echo json_encode(R::findAll('work'));
    
});

$app->get('/work/:id/', function ($id) {
    
        echo json_encode(R::load('work',$id));
    
});

$app->get('/work/visitor/:idVisitor/', function ($idVisitor) {
    
        echo json_encode(R::load('work','visitor_id ='.$idVisitor));
    
});

// Les fiches de frais 

$app->get('/expenseReport/', function () {
    
        echo json_encode(R::findAll('expenseReport'));
    
});

$app->get('/expenseReport/:id/', function ($id) {
    
        echo json_encode(R::load('expenseReport',$id));
    
});

$app->get('/expenseReport/visitor/:idVisitor/', function ($idVisitor) {
    
        echo json_encode(R::load('expenseReport','visitor_id ='.$idVisitor));
    
});

$app->get('/expenseReport/month/:idVisitor/:month/', function ($idVisitor,$month) {
    
        echo json_encode(R::load('expenseReport','visitor_id ='.$idVisitor, 'JJMMAA LIKE %-'.$month.'-%'));
    
});

//Ligne frais hors forfait 

$app->get('/lineExpenseOutPackage/', function () {
    
        echo json_encode(R::findAll('lineExpenseOutPackage'));
    
});

$app->get('/lineExpenseOutPackage/fiche/:idReport/', function ($idReport) {
    
        echo json_encode(R::find('lineExpenseOutPackage','fiche_id = '.$idReport));
    
});

//Ligne frais forfait 

$app->get('/lineExpensePackage/', function () {
    
        echo json_encode(R::findAll('lineExpensePackage'));
    
});

$app->get('/lineExpensePackage/fiche/:idReport/', function ($idReport) {
    
        echo json_encode(R::find('lineExpensePackage','fiche_id = '.$idReport));
    
});

// offer 

$app->get('/offer/', function () {
    
        echo json_encode(R::findAll('offer'));
    
});

$app->get('/offer/:id/', function ($id) {
    
        echo json_encode(R::load('offer', $id));
    
});

$app->get('/offer/visitor/:idVisitor/', function ($idVisitor) {
    
        echo json_encode(R::find('offer','visitor_id ='.$idVisitor));
    
});

$app->get('/offer/medicine/:idMedicine/', function ($idMedicine) {
    
        echo json_encode(R::find('offer','medicine_id ='.$idMedicine));
    
});

//Les practiciens 

$app->get('/practicien/', function () {
    
        echo json_encode(R::findAll('practicien'));
    
});

$app->get('/practicien/:id/', function ($id) {
    
        echo json_encode(R::load('practicien',$id));
    
});

$app->get('/practicien/visitor/:idVisitor', function ($idVisitor) {
    
        echo json_encode(R::find('practicien', 'visitor_id ='.$idVisitor));
    
});


//INSERT
//visitors

$app->get('/visitor/insert/:name/:firstName/:address/:CP/:city/:hiringDate/:login/:password/:idDepartment/:idSector', function ($name,$firstName,$address,$CP,$city,$hiringDate,$login,$password,$idDepartment,$idSector) {
        $insert = R::dispense('visitor');
        $insert->name=$name;
        $insert->first_name=$firstName;
        $insert->address=$address;
        $insert->cp=$CP;        
        $insert->city=$city;        
        $insert->hiring_date=$hiringDate;        
        $insert->login=$login; 
        $insert->password=$password;        
        $insert->department_id =$idDepartment ;
        $insert->sector_id =$idSector;
        $insert->end_contract_date = null;
        R::store($insert);
        echo json_encode($insert);
    
});

//visitReport
$app->get('/visiteReport/insert/:date/:motif/:results/:visitor_id/:practionner_id/', function ($date,$motif,$results,$visitor_id,$practionner_id) {
        $insert = R::dispense('visite_report');
        $insert->date=$date;
        $insert->motif=$motif;
        $insert->results=$results;
        $insert->visitor_id=$visitor_id;        
        $insert->practionner_id=$practionner_id;        
        R::store($insert);
        echo json_encode($insert);
    
});



//UPDATE


//DELETE 




$app->run();




