<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Qualification;
use App\Models\Employment;
use App\Models\Emergency;
use App\Models\Referee;
use App\Models\Questionnaire;
use App\Models\Declaration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Rules\NotNullInArray;

class FormController extends Controller
{
    public function submitForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Position' => 'required|string|max:50',
            'Mode of Application' => 'required|string|max:20',
            'Name' => 'required|string|max:50',
            'Gender' => 'required|string|max:20',
            'Address' => 'required|string|max:200',
            'Email' => 'required|email|max:70',
            'NRIC No' => 'required|string|max:20',
            'Date of Birth' => 'required',
            'Citizenship' => 'required|string|max:20',
            'Race' => 'required|string|max:20',
            'H/Phone' => 'required|string|max:20',
            'Marital Status' => 'required|string|max:20',
            'Driving License' => 'required|string|max:20',
            'Current Salary' => 'required|string|max:20',
            'Earliest Commencement Date' => 'required',
            'Expected Salary' => 'required|string|max:20',

            'questionnaires.achievement' => 'required|string',
            'questionnaires.strengths' => 'required|string',
            'questionnaires.weakness' => 'required|string',
            'questionnaires.employer_describe' => 'required|string',
            'ratings' => ['required', 'array', new NotNullInArray],


            'declaration.medicalCondition' => 'required|string',
            'declaration.conviction' => 'required|string',
            'declaration.businessInvolvement' => 'required|string',
            'signature' => 'required|string',
            'Date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $data = $request->all();

        // return $data;

        $dateOfBirth = $data['Date of Birth'];
        $formattedDateOfBirth = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $dateOfBirth)->format('Y-m-d H:i:s');
        
        $earliestCommencement = $data['Earliest Commencement Date'];
        $formattedearliestCommencement = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $earliestCommencement)->format('Y-m-d H:i:s');

        $user = User::create([
            'position' => $data['Position'],
            'mode_of_application' => $data['Mode of Application'],
            'name' => $data['Name'],
            'gender' => $data['Gender'],
            'address' => $data['Address'],
            'email' => $data['Email'],
            'nric_no' => $data['NRIC No'],
            'date_of_birth' => $formattedDateOfBirth,
            'citizenship' => $data['Citizenship'],
            'race' => $data['Race'],
            'phone' => $data['H/Phone'],
            'marital_status' => $data['Marital Status'],
            'driving_license' => $data['Driving License'],
            'current_salary' => $data['Current Salary'],
            'earliest_commencement_date' => $formattedearliestCommencement,
            'expected_salary' => $data['Expected Salary'],
        ]);

        $qualificationDatas = $data['qualifications']; 

        foreach ($qualificationDatas as $qualificationData) {
            if (
                $qualificationData['Period'] &&
                $qualificationData['School_College_University_Last_Attended'] &&
                $qualificationData['Language Stream'] &&
                $qualificationData['Highest Standard']
            ) {
                Qualification::create([
                    'period' => $qualificationData['Period'],
                    'last_attended_school' => $qualificationData['School_College_University_Last_Attended'],
                    'language_stream' => $qualificationData['Language Stream'],
                    'highest_standard' => $qualificationData['Highest Standard'],
                ]);
            }
        }

        $employmentHistory = $data['employment'];

        foreach ($employmentHistory as $employmentData) {
            if (
                $employmentData['Period'] &&
                $employmentData['Name of Employer'] &&
                $employmentData['Position'] &&
                $employmentData['Salary'] &&
                $employmentData['Reason For Leaving']
            ) {
                Employment::create([
                    'period' => $employmentData['Period'],
                    'name_of_employer' => $employmentData['Name of Employer'],
                    'position' => $employmentData['Position'],
                    'salary' => $employmentData['Salary'],
                    'reason_for_leaving' => $employmentData['Reason For Leaving'],
                ]);
            }
        }

        $emergencyContacts = $data['emergency']; 

        foreach ($emergencyContacts as $contactData) {
            if (
                $contactData['Name'] &&
                $contactData['Relationship'] &&
                $contactData['Contact Number']
            ) {
                Emergency::create([
                    'name' => $contactData['Name'],
                    'relationship' => $contactData['Relationship'],
                    'contact_no' => $contactData['Contact Number'],
                ]);
            }
        }

        $otherReferences = $data['other']; 

        foreach ($otherReferences as $referenceData) {
            if (
                $referenceData['Name of Refree'] &&
                $referenceData['Occupation'] &&
                $referenceData['Name of Company'] &&
                $referenceData['Contact Number'] &&
                $referenceData['Years Known']
            ) {
                Referee::create([
                    'referee_name' => $referenceData['Name of Refree'],
                    'occupation' => $referenceData['Occupation'],
                    'name_of_company' => $referenceData['Name of Company'],
                    'contact_number' => $referenceData['Contact Number'],
                    'years_known' => $referenceData['Years Known'],
                ]);
            }
        }

        $questionnaires = $data['questionnaires']; 
        $ratings = $data['ratings']; 
        $ratingsJson = json_encode($ratings);

        $questionnaires['achievement'] = "ABC";
        $questionnaires['strengths']= "ABC";
        $questionnaires['weakness']= "ABC";
        
        $questionnaires = Questionnaire::create([
            'achievement' => $questionnaires['achievement'],
            'strength' => $questionnaires['strengths'],
            'weakness' => $questionnaires['weakness'],
            'employer_describe' => $questionnaires['employer_describe'],
            'characteristic_rating' => $ratingsJson
        ]);

        $declaration = $data['declaration']; 
        $dateOfDeclaration = $data['Date'];
        $formattedDateOfDeclaration = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $dateOfDeclaration)->format('Y-m-d H:i:s');
        
        $declaration = Declaration::create([
            'medical_condition' => $declaration['medicalCondition'],
            'conviction' => $declaration['conviction'],
            'business_involvement' => $declaration['businessInvolvement'],
            'signature' => $data['signature'],
            'date' => $formattedDateOfDeclaration,
        ]);

        return response()->json(['message' => 'Post Request Successful'], 200);
    }
}
