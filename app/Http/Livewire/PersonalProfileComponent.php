<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class PersonalProfileComponent extends Component
{
    use WithFileUploads;

  
    public $termId;
    public $applicationNo;
    public $studentId;
    public $showPassportFields = false;
    // Personal Information
    public $photo;
    public $name;
    public $cnic;
    public $cnicCopy;
    public $gender = 'male';
    public $dob;
    public $mobile;
    public $passportNo;
    public $passportCopy;
    public $domicile;
    public $email;
    public $nationality = 'pakistani';
    public $province = 'Punjab'; 
    
    // Father's Information
    public $fatherName;
    public $fatherNic;
    public $fatherEmail;
    public $fatherProfession;
    public $fatherCompany;
    public $fatherMobile;
    public $fatherResPhone;
    public $fatherOfficePhone;
    
    // Mailing Address
    public $mailingHouseNo;
    public $mailingStreet;
    public $mailingSector;
    public $mailingTehsil;
    public $mailingCity;
    public $mailingCountry = 'Pakistan';
    public $mailingAddress;
    
    // Permanent Address
    public $sameAsMailing = false;
    public $permanentHouseNo;
    public $permanentStreet;
    public $permanentSector;
    public $permanentTehsil;
    public $permanentCity;
    public $permanentCountry = 'Pakistan';
    public $permanentAddress;

    public function rules()
    {
        $studentId = $this->studentId ?: 'NULL'; // Use 'NULL' string if no ID exists

        $rules = [
            'photo' => 'nullable',
            'name' => 'nullable|string|max:255',
            'cnic' => 'nullable|string|max:15|unique:students,cnic,'.$studentId,
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'mobile' => 'required|string|max:15',
            'passportNo' => 'required_if:nationality,foreign|nullable|string|max:20',
            'domicile' => 'nullable|string|max:100',
            'email' => 'nullable|email|unique:students,email,'.$studentId,
            'nationality' => 'required|in:pakistani,foreign',
            'province' => 'required_if:nationality,local|string|max:50',

            // Father's info
            'fatherName' => 'required|string|max:255',
            'fatherNic' => 'nullable|string|max:15',
            'fatherEmail' => 'nullable|email',
            'fatherMobile' => 'required|string|max:15',

            // Mailing address
            'mailingHouseNo' => 'nullable|string|max:20',
            'mailingStreet' => 'required|string|max:100',
            'mailingSector' => 'nullable|string|max:50',
            'mailingTehsil' => 'nullable|string|max:50',
            'mailingCity' => 'required|string|max:50',
            'mailingCountry' => 'required|string|max:50',

            // Permanent address
            'permanentHouseNo' => 'required_if:sameAsMailing,false|nullable|string|max:20',
            'permanentStreet' => 'required_if:sameAsMailing,false|nullable|string|max:100',
            'permanentSector' => 'required_if:sameAsMailing,false|nullable|string|max:50',
            'permanentTehsil' => 'required_if:sameAsMailing,false|nullable|string|max:50',
            'permanentCity' => 'required_if:sameAsMailing,false|nullable|string|max:50',
            'permanentCountry' => 'required_if:sameAsMailing,false|nullable|string|max:50',
        ];

        // Only validate new CNIC copy file
        if (is_object($this->cnicCopy)) {
            $rules['cnicCopy'] = 'nullable|file|mimes:pdf,jpg,png|max:2048';
        }

        // Only validate new passport copy file
        if ($this->nationality === 'foreign' && is_object($this->passportCopy)) {
            $rules['passportCopy'] = 'required|file|mimes:pdf,jpg,png|max:2048';
        }

        return $rules;
    }

    public function mount($termId)
    {
        $this->termId = $termId;
    
        $user = Auth::user();
        $this->showPassportFields = $user->nationality !== 'local';
    
        // Always try to load the student record for this user and term
        $student = Student::where('user_id', $user->id)
                         ->where('term_id', $termId)
                         ->first();
    
        if ($student) {
            $this->studentId = $student->id;
            $this->applicationNo = $student->application_no;
            $this->name = $student->name;
            $this->cnic = $student->cnic;
            $this->gender = $student->gender;
            $this->dob = $student->dob;
            $this->mobile = $student->mobile;
            $this->passportNo = $student->passport_no;
            $this->domicile = $student->domicile;
            $this->email = $student->email;
            $this->nationality = $student->nationality;
            $this->province = $student->province;
    
            // Father's info
            $this->fatherName = $student->father_name;
            $this->fatherNic = $student->father_nic;
            $this->fatherEmail = $student->father_email;
            $this->fatherProfession = $student->father_profession;
            $this->fatherCompany = $student->father_company;
            $this->fatherMobile = $student->father_mobile;
            $this->fatherResPhone = $student->father_res_phone;
            $this->fatherOfficePhone = $student->father_office_phone;
    
            // Addresses
            $this->mailingHouseNo = $student->mailing_house_no;
            $this->mailingStreet = $student->mailing_street;
            $this->mailingSector = $student->mailing_sector;
            $this->mailingTehsil = $student->mailing_tehsil;
            $this->mailingCity = $student->mailing_city;
            $this->mailingCountry = $student->mailing_country;
            $this->mailingAddress = $student->mailing_address;
    
            $this->permanentHouseNo = $student->permanent_house_no;
            $this->permanentStreet = $student->permanent_street;
            $this->permanentSector = $student->permanent_sector;
            $this->permanentTehsil = $student->permanent_tehsil;
            $this->permanentCity = $student->permanent_city;
            $this->permanentCountry = $student->permanent_country;
            $this->permanentAddress = $student->permanent_address;
            $this->sameAsMailing = $student->mailing_address === $student->permanent_address;
    
            // Previously uploaded attachments
            $this->photo = $student->photo_path;
            $this->cnicCopy = $student->cnic_copy_path;
            $this->passportCopy = $student->passport_copy_path;
        } else {
            // New entry
            $this->name = $user->name;
            $this->email = $user->email;
            $this->cnic = $user->cnic;
            
            // Determine application number based on registration date
            $cutoffDate = '2025-07-16';
            
            if ($user->created_at->lt($cutoffDate)) {
                // For users registered before July 16, 2025 - format: 10410 (user_id + 10000)
                $this->applicationNo = 'STMU-' . date('Y') . '-' . $user->id + 10000;
            } else {
                // For users registered on or after July 16, 2025 - format: STMU-YEAR-00001
                $this->applicationNo = 'STMU-' . date('Y') . '-' . str_pad($user->id, 5, '0', STR_PAD_LEFT);
            }
        }
    }

    public function updatedNationality($value)
    {
        $this->showPassportFields = $value === 'foreign';
    }

    public function updatedSameAsMailing($value)
    {
        if ($value) {
            $this->permanentHouseNo = $this->mailingHouseNo;
            $this->permanentStreet = $this->mailingStreet;
            $this->permanentSector = $this->mailingSector;
            $this->permanentTehsil = $this->mailingTehsil;
            $this->permanentCity = $this->mailingCity;
            $this->permanentCountry = $this->mailingCountry;
            $this->permanentAddress = $this->mailingAddress;
        }
    }

    public function save()
    {
        $this->validate();

        // Address formatting
        $this->mailingAddress = "House #{$this->mailingHouseNo}, Street: {$this->mailingStreet}, Sector: {$this->mailingSector}, Tehsil: {$this->mailingTehsil}, City: {$this->mailingCity}, Country: {$this->mailingCountry}";

        if (!$this->sameAsMailing) {
            $this->permanentAddress = "House #{$this->permanentHouseNo}, Street: {$this->permanentStreet}, Sector: {$this->permanentSector}, Tehsil: {$this->permanentTehsil}, City: {$this->permanentCity}, Country: {$this->permanentCountry}";
        }

        $data = [
            'application_no' => $this->applicationNo,
            'name' => $this->name,
            'cnic' => $this->cnic,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'mobile' => $this->mobile,
            'passport_no' => $this->passportNo,
            'domicile' => $this->domicile,
            'email' => $this->email,
            'nationality' => $this->nationality,
            'province' => $this->province,
            'father_name' => $this->fatherName,
            'father_nic' => $this->fatherNic,
            'father_email' => $this->fatherEmail,
            'father_profession' => $this->fatherProfession,
            'father_company' => $this->fatherCompany,
            'father_mobile' => $this->fatherMobile,
            'father_res_phone' => $this->fatherResPhone,
            'father_office_phone' => $this->fatherOfficePhone,
            'mailing_address' => $this->mailingAddress,
            'mailing_house_no' => $this->mailingHouseNo,
            'mailing_street' => $this->mailingStreet,
            'mailing_sector' => $this->mailingSector,
            'mailing_tehsil' => $this->mailingTehsil,
            'mailing_city' => $this->mailingCity,
            'mailing_country' => $this->mailingCountry,
            'permanent_address' => $this->permanentAddress,
            'permanent_house_no' => $this->permanentHouseNo,
            'permanent_street' => $this->permanentStreet,
            'permanent_sector' => $this->permanentSector,
            'permanent_tehsil' => $this->permanentTehsil,
            'permanent_city' => $this->permanentCity,
            'permanent_country' => $this->permanentCountry,
        ];

        // File upload logic (new or keep existing path)
        if ($this->photo && is_object($this->photo)) {
            $data['photo_path'] = $this->photo->store('student-photos', 'public');
        } elseif (is_string($this->photo)) {
            $data['photo_path'] = $this->photo;
        }

        if ($this->cnicCopy && is_object($this->cnicCopy)) {
            $data['cnic_copy_path'] = $this->cnicCopy->store('cnic-copies', 'public');
        } elseif (is_string($this->cnicCopy)) {
            $data['cnic_copy_path'] = $this->cnicCopy;
        }

        if ($this->nationality === 'foreign') {
            if ($this->passportCopy && is_object($this->passportCopy)) {
                $data['passport_copy_path'] = $this->passportCopy->store('passport-copies', 'public');
            } elseif (is_string($this->passportCopy)) {
                $data['passport_copy_path'] = $this->passportCopy;
            }
        }

        if ($this->studentId) {
            // Update existing record
            $student = Student::find($this->studentId);
            $student->update($data);
        } else {
            // Create new record
            $data['user_id'] = Auth::id();
            $data['term_id'] = $this->termId;
            $student = Student::create($data);
            $this->studentId = $student->id;
        }

        $this->dispatch('personalProfileSaved', studentId: $student->id);
    }

    public function render()
    {
        return view('livewire.personal-profile-component');
    }
}