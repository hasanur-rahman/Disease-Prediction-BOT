<?php
/**
 *   (C) Copyright 1997-2013 hSenid International (pvt) Limited.
 *   All Rights Reserved.
 *
 *   These materials are unpublished, proprietary, confidential source code of
 *   hSenid International (pvt) Limited and constitute a TRADE SECRET of hSenid
 *   International (pvt) Limited.
 *
 *   hSenid International (pvt) Limited retains all title to and intellectual
 *   property rights in these materials.
 */

include_once 'MoUssdReceiver.php';
include_once 'MtUssdSender.php';
include_once 'log.php';
include_once 'SmsReceiver.php';
include_once 'SmsSender.php';
ini_set('error_log', 'sms-app-error.log');
include_once 'C:\xampp\htdocs\server\BOT2\interface.php';
include_once 'C:\xampp\htdocs\server\SymptomsSave.php';
startModel();
//error_log("Error message\n", 3, "C:\xampp\htdocs\server\errors.log");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


$receiver = new MoUssdReceiver(); // Create the Receiver object

$receiverSessionId = $receiver->getSessionId();
session_id($receiverSessionId); //Use received session id to create a unique session
session_start();

$content = $receiver->getMessage(); // get the message content
$address = $receiver->getAddress(); // get the senptoder's address
$requestId = $receiver->getRequestID(); // get the request ID
$applicationId = $receiver->getApplicationId(); // get application ID
$encoding = $receiver->getEncoding(); // get the encoding value
$version = $receiver->getVersion(); // get the version
$sessionId = $receiver->getSessionId(); // get the session ID;
$ussdOperation = $receiver->getUssdOperation(); // get the ussd operation

logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version, sessionId=$sessionId, ussdOperation=$ussdOperation ]");

//$myfile = fopen("symptoms.txt", "a");
$flag = 0;

//your logic goes here......
$responseMsg = array(
    // "main" => "Choose options:
    // 1.provide symptoms
    // 2.first aid tips
    // 000.exit",
    //
    // "aid" => "1.BLEEDING
    // 2."

    "main1" => "choose symptoms
    1.a
    2.b
    3.c
    4.d
    5.e
    6.f
    7.next
    000.exit",

    "main2" =>  "choose symptoms
    1.g
    2.h
    3.i
    4.j
    5.k
    6.l
    7.next
    8.back
    000.exit",

    "main3" =>  "choose symptoms
    1.m
    2.n
    3.o
    4.p
    5.q
    6.r
    7.next
    8.back
    000.exit",

    "main4" =>  "choose symptoms
    1.s
    2.t
    3.u
    4.v
    5.w
    6.x
    7.next
    8.back
    000.exit",

    "main5" =>  "choose symptoms
    1.y
    2.z
    3.back
    000.exit",

    "prompt" => "Do you want to enter more symptoms?
    1.yes
    2.no",

    "a1" => "1.acidity
    2.anxiety
    3.abdominal_pain
    4.acute_liver_failure
    5.next
    6.back to main",

    "a2" => "1.altered_sensorium
    2.abnormal_menstruation
    3.back
    4.back to main",

    "b1" => "1.burning_micturition
    2.breathlessness
    3.back_pain
    4.blurred_and_distorted_vision
    5.next
    6.back to main",

    "b2" => "1.brittle_nails
    2.bladder_discomfort
    3.belly_pain
    4.next
    5.back
    6.back to main",

    "b3" => "1.bloody_stool
    2.bruising
    3.blackheads
    4.next
    5.back
    6.back to main",

    "b4" => "1.blood_in_sputum
    2.blister
    3.back
    4.back to main",

    "c1" =>  "1.continuous_sneezing
    2.chills
    3.cold_hands_and_feets
    4.cough
    5.next
    6.back to main",

    "c2" => "1.chest_pain
    2.cramps
    3.continuous_feel_of_urine
    4.next
    5.back
    6.back to main",

    "c3" => "1.constipation
    2.congestion
    3.coma
    4.back
    5.back to main",

    "d1" =>  "1.dehydration
    2.dark_urine
    3.diarrhoea
    4.dizziness
    5.next
    6.back to main",

    "d2" => "1.depression
    2.dischromic_patches
    3.distention_of_abdomen
    4.drying_and_tingling_lips
    5.back
    6.back to main",

    "e" =>  "1.enlarged_thyroid
    2.excessive_hunger
    3.extra_marital_contacts
    4.back to main",

    "f1" =>  "1.fatigue
    2.fluid_overload
    3.fast_heart_rate
    4.foul_smell_of_urine
    5.next
    7.back to main",

    "f2" => "1.family_history
    2.fluid_overload
    3.back
    4.back to main",

    "g" =>  "No symptoms available!
    1.back to main",

    "h" =>  "1.high_fever
    2.headache
    3.hip_joint_pain
    4.history_of_alcohol_consumption
    5.back to main",

    "i1" =>  "1.itching
    2.irregular_sugar_level
    3.indigestion
    4.irritation_in_anus
    5.next
    6.back to main",

    "i2" => "1.internal_itching
    2.irritability
    3.increased_appetite
    4.inflammatory_nails
    5.back
    6.back to main",

    "j" =>  "1.joint_pain
    2.back to main",

    "k" =>  "1.knee_pain
    2.back to main",

    "l" =>  "1.lethargy
    2.loss_of_appetite
    3.loss_of_balance
    4.loss_of_smell
    5.lack_of_concentration
    6.back to main",

    "m1" => "1.muscle_wasting
    2.mood_swings
    3.mild_fever
    4.malaise
    5.next
    6.back to main",

    "m2" => "1.muscle_weakness
    2.movement_stiffness
    3.muscle_pain
    4.mucoid_sputum
    5.back
    6.back to main",

    "n" =>  "1.nodal_skin_eruptions
    2.nausea
    3.neck_pain
    4.back to main",

    "o" =>  "1.obesity
    2.back to main",

    "p1" =>  "1.patches_in_throat
    2.pain_behind_the_eyes
    3.phlegm
    4.passage_of_gases
    5.next
    6.back to main",


    "p2" => "1.polyuria
    2.prominent_veins_on_calf
    3.palpitations
    4.pus_filled_pimples
    5.next
    6.back
    7.back to main",

    "p3" => "1.pain_during_bowel_movements
    2.pain_in_anal_region
    3.next
    4.back
    5.back to main",

    "p4" => "1.puffy_face_and_eyes
    2.painful_walking
    3.back
    4.back to main",

    "q" => "No symptoms available!
    1.back to main",

    "r1" =>  "1.restlessness
    2.redness_of_eyes
    3.runny_nose
    4.red_spots_over_body
    5.next
    6.back to main",

    "r2" => "1.rusty_sputum
    2.receiving_blood_transfusion
    3.receiving_unsterile_injections
    4.red_sore_around_nose
    5.back
    6.back to main",

    "s1" =>  "1.skin_rash
    2.shivering
    3.stomach_pain
    4.spotting_urination
    5.next
    6.back to main",


    "s2" => "1.swelled_lymph_nodes
    2.sinus_pressure
    3.swollen_legs
    4.next
    5.back
    6.back to main",

    "s3" => "1.spinning_movements
    2.stomach_bleeding
    3.scurring
    4.next
    5.back
    6.back to main",

    "s4" => "1.silver_like_dusting
    2.small_dents_in_nails
    3.swelling_joints
    4.next
    5.back
    6.back to main",

    "s5" => "1.stiff_neck
    2.swollen_blood_vessels
    3.swollen_extremeties
    4.slurred_speech
    5.next
    6.back
    7.back to main",

    "s6" => "1.sunken_eyes
    2.sweating
    3.swelling_of_stomach
    4.skin_peeling
    5.back
    6.back to main",

    "t" =>  "1.throat_irritation
    2.toxic_look_(typhos)
    3.back to main",

    "u" =>  "1.ulcers_on_tongue
    2.unsteadiness
    3.back to main",

    "v" => "1.vomiting
    2.visual_disturbances
    3.back to main",

    "w" =>  "1.weight_gain
    2.weight_loss
    3.weakness_in_limbs
    4.weakness_of_one_body_side
    5.watering_from_eyes
    6.back to main",

    "x" =>  "No symptoms available!
    1.back to main",

    "y" => "1.yellowish_skin
    2.yellow_urine
    3.yellowing_of_eyes
    4.yellow_crust_ooze
    5.back to main",

    "z" =>  "No symptoms available!
    1.back to main"



 );
//////
$symptom = array();

logFile("Previous Menu is := " . $_SESSION['menu-Opt']); //Get previous menu number
if (($receiver->getUssdOperation()) == "mo-init") { //Send the main menu
    loadUssdSender($sessionId, $responseMsg["main1"]);
    unset($_SESSION['menu-Opt']);
    if (!(isset($_SESSION['menu-Opt']))) {
        $_SESSION['len'] = 0;
        $_SESSION['array'] = array();
        $_SESSION['menu-Opt'] = "main1"; //Initialize main menu
    }

}
if (($receiver->getUssdOperation()) == "mo-cont") {
    $menuName = null;

    switch ($_SESSION['menu-Opt']) {

      case "main1":
          switch ($receiver->getMessage()) {
              case "1":
                  $menuName = "a1";
                  break;
              case "2":
                  $menuName = "b1";
                  break;
              case "3":
                  $menuName = "c1";
                  break;
              case "4":
                  $menuName = "d1";
                  break;
              case "5":
                  $menuName = "e";
                  break;
              case "6":
                  $menuName = "f1";
                  break;
              case "7":
                  $menuName = "main2";
                  break;
              default:
                  $menuName = "main1";
                  break;
          }
          $_SESSION['menu-Opt'] = $menuName; //Assign session menu name
          break;

      case "main2":
          //"$_SESSION['menu-Opt'] = "company-hist"; //Set to company menu back
          switch ($receiver->getMessage()) {
              case "1":
                  $menuName = "g";
                  break;
              case "2":
                  $menuName = "h";
                  break;
              case "3":
                  $menuName = "i1";
                  break;
              case "4":
                  $menuName = "j";
                  break;
              case "5":
                  $menuName = "k";
                  break;
              case "6":
                  $menuName = "l";
                  break;
              case "7":
                  $menuName = "main3";
                  break;
              case "8":
                  $menuName = "main1";
                  break;
              default:
                  $menuName = "main2";
                  break;
          }
          $_SESSION['menu-Opt'] = $menuName;
          break;

      case "main3":
         // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
          switch ($receiver->getMessage()) {
              case "1":
                  $menuName = "m1";
                  break;
              case "2":
                  $menuName = "n";
                  break;
              case "3":
                  $menuName = "o";
                  break;
              case "4":
                  $menuName = "p1";
                  break;
              case "5":
                  $menuName = "q";
                  break;
              case "6":
                  $menuName = "r1";
                  break;
              case "7":
                  $menuName = "main4";
                  break;
              case "8":
                  $menuName = "main2";
                  break;
              default:
                  $menuName = "main3";
                  break;
          }
          $_SESSION['menu-Opt'] = $menuName;
          break;

        case "main4":
            //$_SESSION['menu-Opt'] = "careers-hist"; //Set to career menu back
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "s1";
                    break;
                case "2":
                    $menuName = "t";
                    break;
                case "3":
                    $menuName = "u";
                    break;
                case "4":
                    $menuName = "v";
                    break;
                case "5":
                    $menuName = "w";
                    break;
                case "6":
                    $menuName = "x";
                    break;
                case "7":
                    $menuName = "main5";
                    break;
                case "8":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "main4";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "main5":
            //$_SESSION['menu-Opt'] = "careers-hist"; //Set to career menu back
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "y";
                    break;
                case "2":
                    $menuName = "z";
                    break;
                case "3":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "main5";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

          case "a1":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "acidity");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "anxiety");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "abdominal_pain");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "acute_liver_failure");
                     break;
             		 case "5":
                      $menuName = "a2";
                      break;
                  case "6":
                      $menuName = "main1";
                             break;
                  default:
                      $menuName = "a1";
                      break;
                  }
                  $_SESSION['menu-Opt'] = $menuName;
                     break;

         case "a2":
         	$menuName = "prompt";
         	switch ($receiver->getMessage()) {
         		case "1":
                     array_push($_SESSION['array'], "altered_sensorium");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "abnormal_menstruation");
                     break;
                 case "3":
     				         $menuName = "a1";
                     break;
                 case "4":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "a2";
                     break;
         	}
         	$_SESSION['menu-Opt'] = $menuName;
             break;

         case "b1":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "burning_micturition");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "breathlessness");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "back_pain");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "blurred_and_distorted_vision");
                     break;
                 case "5":
                     $menuName = "b2";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "b1";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "b2":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "brittle_nails");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "bladder_discomfort");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "belly_pain");
                     break;
                 case "4":
                     $menuName = "b3";
                     break;
                 case "5":
                     $menuName = "b1";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "b2";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "b3":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
             	case "1":
                     array_push($_SESSION['array'], "bloody_stool");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "bruising");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "blackheads");
                     break;
                 case "4":
                     $menuName = "b4";
                     break;
                 case "5":
                     $menuName = "b2";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "b3";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "b4":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "blood_in_sputum");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "blister");
                     break;
                 case "3":
                     $menuName = "b3";
                     break;
                 case "4":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "b4";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "c1":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "continuous_sneezing");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "chills");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "cold_hands_and_feets");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "cough");
                     break;
                 case "5":
                     $menuName = "c2";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "c1";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "c2":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "chest_pain");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "cramps");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "continuous_feel_of_urine");
                     break;
                 case "4":
                     $menuName = "c3";
                     break;
                 case "5":
                     $menuName = "c1";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "c2";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "c3":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
             	 case "1":
                     array_push($_SESSION['array'], "constipation");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "congestion");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "coma");
                     break;
                 case "4":
                     $menuName = "c2";
                     break;
                 case "5":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "c3";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "d1":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "dehydration");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "dark_urine");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "diarrhoea");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "dizziness");
                     break;
                 case "5":
                     $menuName = "d2";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "d1";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "d2":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "drying_and_tingling_lips");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "depression");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "dischromic_patches");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "distention_of_abdomen");
                     break;
                 case "5":
                     $menuName = "d1";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "d2";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "e":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "enlarged_thyroid");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "excessive_hunger");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "extra_marital_contacts");
                     break;
                 case "4":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "e";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "f1":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "fatigue");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "fluid_overload");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "fast_heart_rate");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "foul_smell_of_urine");
                     break;
                 case "5":
                     $menuName = "f2";
                     break;
                 case "6":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "f1";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "f2":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "family_history");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "fluid_overload");
                     break;
                 case "3":
                     $menuName = "f1";
                     break;
                 case "4":
                     $menuName = "main1";
                     break;
                 default:
                     $menuName = "f2";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "g":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     $menuName = "main2";
                     break;
                 default:
                     $menuName = "g";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "h":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "high_fever");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "headache");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "hip_joint_pain");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "history_of_alcohol_consumption");
                     break;
                 case "5":
                     $menuName = "main2";
                     break;
                 default:
                     $menuName = "h";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "i1":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "itching");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "irregular_sugar_level");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "indigestion");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "irritation_in_anus");
                     break;
                 case "5":
                     $menuName = "i2";
                     break;
                 case "6":
                     $menuName = "main2";
                     break;
                 default:
                     $menuName = "i1";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;


          case "i2":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "internal_itching");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "irritability");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "increased_appetite");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "inflammatory_nails");
                     break;
                 case "5":
                     $menuName = "i1";
                     break;
                 case "6":
                     $menuName = "main2";
                     break;
                 default:
                     $menuName = "i2";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "j":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "joint_pain");
                     break;
                 case "2":
                     $menuName = "main2";
                     break;
                 default:
                     $menuName = "j";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "k":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "knee_pain");
                     break;
                 case "2":
                     $menuName = "main2";
                     break;
                 default:
                     $menuName = "k";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "l":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "lethargy");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "loss_of_appetite");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "loss_of_balance");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "loss_of_smell");
                     break;
                 case "5":
                     array_push($_SESSION['array'], "lack_of_concentration");
                     break;
                 case "6":
                     $menuName = "main2";
                     break;
                 default:
                     $menuName = "l";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

         case "m1":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "muscle_wasting");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "mood_swings");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "mild_fever");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "malaise");
                     break;
                 case "5":
                     $menuName = "m2";
                     break;
                 case "6":
                     $menuName = "main3";
                     break;
                 default:
                     $menuName = "m1";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

             case "m2":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "muscle_weakness");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "movement_stiffness");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "muscle_pain");
                     break;
                 case "4":
                     array_push($_SESSION['array'], "mucoid_sputum");
                     break;
                 case "5":
                     $menuName = "m1";
                     break;
                 case "6":
                     $menuName = "main3";
                     break;
                 default:
                     $menuName = "m2";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

             case "n":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "nodal_skin_eruptions");
                     break;
                 case "2":
                     array_push($_SESSION['array'], "nausea");
                     break;
                 case "3":
                     array_push($_SESSION['array'], "neck_pain");
                     break;
                 case "4":
                     $menuName = "main3";
                     break;
                 default:
                     $menuName = "n";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

             case "o":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
             $menuName = "prompt";
             switch ($receiver->getMessage()) {
                 case "1":
                     array_push($_SESSION['array'], "obesity");
                     break;
                 case "2":
                     $menuName = "main3";
                     break;
                 default:
                     $menuName = "o";
                     break;
             }
             $_SESSION['menu-Opt'] = $menuName;
             break;

        case "p1":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "patches_in_throat");
                    break;
                case "2":
                    array_push($_SESSION['array'], "pain_behind_the_eyes");
                    break;
                case "3":
                    array_push($_SESSION['array'], "phlegm");
                    break;

                case "4":
                    array_push($_SESSION['array'], "passage_of_gases");
                    break;
                case "5":
                    $menuName = "p2";
                    break;
                case "6":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "p1";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "p2":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "polyuria");
                    break;
                case "2":
                    array_push($_SESSION['array'], "prominent_veins_on_calf");
                    break;
                case "3":
                    array_push($_SESSION['array'], "palpitations");
                    break;
                case "4":
                    array_push($_SESSION['array'], "pus_filled_pimples");
                    break;
                case "5":
                    $menuName = "p3";
                    break;
                case "6":
                    $menuName = "p1";
                    break;
                case "7":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "p2";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "p3":
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "pain_during_bowel_movements");
                    break;
                case "2":
                    array_push($_SESSION['array'], "pain_in_anal_region");
                    break;
                case "3":
                    $menuName = "p4";
                    break;
                case "4":
                    $menuName = "p2";
                    break;
                case "5":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "p3";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "p4":
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "puffy_face_and_eyes");
                    break;
                case "2":
                    array_push($_SESSION['array'], "painful_walking");
                    break;
                case "3":
                    $menuName = "p3";
                    break;
                case "4":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "p4";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "q":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "q";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "r1":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "restlessness");
                    break;
                case "2":
                    array_push($_SESSION['array'], "redness_of_eyes");
                    break;
                case "3":
                    array_push($_SESSION['array'], "runny_nose");
                    break;
                case "4":
                    array_push($_SESSION['array'], "red_spots_over_body");
                    break;
                case "5":
                    $menuName = "r2";
                    break;
                case "6":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "r1";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "r2":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "rusty_sputum");
                    break;
                case "2":
                    array_push($_SESSION['array'], "receiving_blood_transfusion");
                    break;
                case "3":
                    array_push($_SESSION['array'], "receiving_unsterile_injections");
                    break;
                case "4":
                    array_push($_SESSION['array'], "red_sore_around_nose");
                    break;
                case "5":
                    $menuName = "r1";
                    break;
                case "6":
                    $menuName = "main3";
                    break;
                default:
                    $menuName = "r2";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;



        case "s1":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "skin_rash");
                    break;
                case "2":
                    array_push($_SESSION['array'], "shivering");
                    break;
                case "3":
                    array_push($_SESSION['array'], "stomach_pain");
                    break;
                case "4":
                    array_push($_SESSION['array'], "spotting_urination");
                    break;

                case "5":
                    $menuName = "s2";
                    break;
                case "6":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "s1";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "s2":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "swelled_lymph_nodes");
                    break;
                case "2":
                    array_push($_SESSION['array'], "sinus_pressure");
                    break;
                case "3":
                    array_push($_SESSION['array'], "swollen_legs");
                    break;
                case "4":
                    $menuName = "s3";
                    break;
                case "5":
                    $menuName = "s1";
                    break;
                case "6":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "s2";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "s3":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "spinning_movements");
                    break;
                case "2":
                    array_push($_SESSION['array'], "stomach_bleeding");
                    break;
                case "3":
                    array_push($_SESSION['array'], "scurring");
                    break;
                case "4":
                    $menuName = "s4";
                    break;
                case "5":
                    $menuName = "s2";
                    break;
                case "6":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "s3";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "s4":
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "silver_like_dusting");
                    break;
                case "2":
                    array_push($_SESSION['array'], "small_dents_in_nails");
                    break;
                case "3":
                    array_push($_SESSION['array'], "swelling_joints");
                    break;
                case "4":
                    $menuName = "s5";
                    break;
                case "5":
                    $menuName = "s3";
                    break;
                case "6":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "s4";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "s5":
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "stiff_neck");
                    break;
                case "2":
                    array_push($_SESSION['array'], "swollen_blood_vessels");
                    break;
                case "3":
                    array_push($_SESSION['array'], "swollen_extremeties");
                    break;
                case "4":
                    array_push($_SESSION['array'], "slurred_speech");
                    break;
                case "5":
                    $menuName = "s6";
                    break;
                case "6":
                    $menuName = "s4";
                    break;
                case "7":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "s5";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "s6":
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "sunken_eyes");
                    break;
                case "2":
                    array_push($_SESSION['array'], "sweating");
                    break;
                case "3":
                    array_push($_SESSION['array'], "swelling_of_stomach");
                    break;
                case "4":
                    array_push($_SESSION['array'], "skin_peeling");
                    break;
                case "5":
                    $menuName = "s5";
                    break;
                case "6":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "s6";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "t":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "throat_irritation");
                    break;
                case "2":
                    array_push($_SESSION['array'], "toxic_look_(typhos)");
                    break;
                case "3":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "t";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "u":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "ulcers_on_tongue");
                    break;
                case "2":
                    array_push($_SESSION['array'], "unsteadiness");
                    break;
                case "3":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "u";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;



        case "v":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "vomiting");
                    break;
                case "2":
                    array_push($_SESSION['array'], "visual_disturbances");
                    break;
                case "3":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "v";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;



        case "w":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "weight_gain");
                    break;
                case "2":
                    array_push($_SESSION['array'], "weight_loss");
                    break;
                case "3":
                    array_push($_SESSION['array'], "weakness_in_limbs");
                    break;
                case "4":
                    array_push($_SESSION['array'], "weakness_of_one_body_side");
                    break;
                case "5":
                    array_push($_SESSION['array'], "watering_from_eyes");
                    break;
                case "6":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "w";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "x":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "main4";
                    break;
                default:
                    $menuName = "x";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "y":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    array_push($_SESSION['array'], "yellowish_skin");
                    break;
                case "2":
                    array_push($_SESSION['array'], "yellow_urine");
                    break;
                case "3":
                    array_push($_SESSION['array'], "yellowing_of_eyes");
                    break;
                case "4":
                    array_push($_SESSION['array'], "yellow_crust_ooze");
                    break;
                case "5":
                    $menuName = "main5";
                    break;
                default:
                    $menuName = "y";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;


        case "z":
           // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "main5";
                    break;
                default:
                    $menuName = "z";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

        case "prompt":
            // $_SESSION['menu-Opt'] = "products-hist"; //Set to product menu back
            $menuName = "prompt";
            switch ($receiver->getMessage()) {
                case "1":
                    $menuName = "main1";
                    break;
                case "2":
                    $flag = 1;
                    break;
                default:
                    $menuName = "prompt";
                    break;
            }
            $_SESSION['menu-Opt'] = $menuName;
            break;

    }

    if ($receiver->getMessage() == "000" || $flag == 1) {
        $responseExitMsg = "Exit Program!";
        $response = loadUssdSender($sessionId, $responseExitMsg);


        //xtra
        /*$symptsom =  array();
        $handle = fopen("symptoms.txt", "r");
        while (($line = fgets($handle)) !== false) {
            $line = "\"".$line."\"";
            $type = gettype($line);
            logFile("type : ".$type);
            logFile("word : ".$line);
            logFile("count : ".strlen($line));
            foreach ($line as $ch){
                logFile("letter : ".$ch."\n");
            }
            array_push($_SESSION['array'], $line);
        }

        fclose($handle);
        logFile("symptoms : ".count($symptom));*/
        logFile("session len : ".$_SESSION['len']);

        logFile("symtoms len : ". count($_SESSION['array']));
        logFile("symtom :".$_SESSION['array']);
        foreach ($_SESSION['array'] as $item) {
          logFile("s : ".$item);
        }
        $rifat = prediction($_SESSION['array']);
        $val = "";
        for ($i = 2; $i < strlen($rifat) - 3; $i++)
        {
          $val .= $rifat[$i];
        }
        logFile("output ".$rifat);
        $val = "you are probably suffering from ".$val;
        try {

            $responseMsg = $val;

            // Create the sender object server url
            $sender = new SmsSender("https://localhost:7443/sms/send");

            //sending a one message

            $applicationId = "APP_000001";
            $encoding = "0";
            $version =  "1.0";
            $password = "password";
            $sourceAddress = "77000";
            $deliveryStatusRequest = "1";
            $charging_amount = ":15.75";
            $destinationAddresses = array("tel:94771122336");
            $binary_header = "";
            $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);

        } catch (SmsException $ex) {
            //throws when failed sending or receiving the sms
            error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
        }
        /////////
        /////to do
        ////////
        //$symptom = array();
        //delete('symptoms.txt');
        session_destroy();

    } else {
        logFile("Selected response message := " . $responseMsg[$menuName]);
        $response = loadUssdSender($sessionId, $responseMsg[$menuName]);
    }

}

/*
    Get the session id and Response message as parameter
    Create sender object and send ussd with appropriate parameters
**/

function loadUssdSender($sessionId, $responseMessage)
{
    global $symptom,$myfile;
    $password = "password";
    $destinationAddress = "tel:94771122336";
    if ($responseMessage == "000") {
        $ussdOperation = "mt-fin";
    } else {
        $ussdOperation = "mt-cont";
    }
    $chargingAmount = "5";
    $applicationId = "APP_000001";
    $encoding = "440";
    $version = "1.0";

    /*if(count($symptom) != 0){
        fwrite($myfile, $symptom[0]."\n");

    }
    fclose($myfile);*/

    try {
        // Create the sender object server url

//        $sender = new MtUssdSender("http://localhost:7000/ussd/send/");   // Application ussd-mt sending http url
        $sender = new MtUssdSender("https://localhost:7443/ussd/send/"); // Application ussd-mt sending https url
        $response = $sender->ussd($applicationId, $password, $version, $responseMessage,
            $sessionId, $ussdOperation, $destinationAddress, $encoding, $chargingAmount);
        return $response;
    } catch (UssdException $ex) {
        //throws when failed sending or receiving the ussd
        error_log("USSD ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
        return null;
    }
}

//////////////


?>
