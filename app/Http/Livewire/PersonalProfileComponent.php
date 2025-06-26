<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;

class PersonalProfileComponent extends Component
{
    use WithFileUploads;

    public $termId;
    public $applicationNo;
    
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
    public $province;
    
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

    protected $rules = [
        'photo' => 'required|image|max:1024',
        'name' => 'required|string|max:255',
        'cnic' => 'required|string|max:15|unique:students,cnic',
        'cnicCopy' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'gender' => 'required|in:male,female,other',
        'dob' => 'required|date',
        'mobile' => 'required|string|max:15',
        'passportNo' => 'required_if:nationality,foreign|nullable|string|max:20',
        'passportCopy' => 'required_if:nationality,foreign|nullable|file|mimes:pdf,jpg,png|max:2048',
        'domicile' => 'required|string|max:100',
        'email' => 'required|email|unique:students,email',
        'nationality' => 'required|in:pakistani,foreign',
        'province' => 'required|string|max:50',
        
        // Father's information
        'fatherName' => 'required|string|max:255',
        'fatherNic' => 'required|string|max:15',
        'fatherEmail' => 'nullable|email',
        'fatherMobile' => 'required|string|max:15',
        
        // Mailing address
        'mailingHouseNo' => 'required|string|max:20',
        'mailingStreet' => 'required|string|max:100',
        'mailingSector' => 'required|string|max:50',
        'mailingTehsil' => 'required|string|max:50',
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

    public function mount($termId)
    {
        $this->termId = $termId;
        $this->applicationNo = 'STMU-' . date('Y') . '-' . str_pad(Student::count() + 1, 5, '0', STR_PAD_LEFT);
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

        // Generate mailing address
        $this->mailingAddress = "House #{$this->mailingHouseNo}, Street: {$this->mailingStreet}, Sector: {$this->mailingSector}, Tehsil: {$this->mailingTehsil}, City: {$this->mailingCity}, Country: {$this->mailingCountry}";
        
        // Generate permanent address if different
        if (!$this->sameAsMailing) {
            $this->permanentAddress = "House #{$this->permanentHouseNo}, Street: {$this->permanentStreet}, Sector: {$this->permanentSector}, Tehsil: {$this->permanentTehsil}, City: {$this->permanentCity}, Country: {$this->permanentCountry}";
        }

        // Store files
        $photoPath = $this->photo->store('student-photos', 'public');
        $cnicCopyPath = $this->cnicCopy->store('cnic-copies', 'public');
        $passportCopyPath = $this->nationality === 'foreign' ? $this->passportCopy->store('passport-copies', 'public') : null;

        // Create student record
        $student = Student::create([
            'application_no' => $this->applicationNo,
            'photo_path' => $photoPath,
            'name' => $this->name,
            'cnic' => $this->cnic,
            'cnic_copy_path' => $cnicCopyPath,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'mobile' => $this->mobile,
            'passport_no' => $this->passportNo,
            'passport_copy_path' => $passportCopyPath,
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
            'term_id' => $this->termId,
        ]);

       $this->dispatch('personalProfileSaved', studentId: $student->id);
    }

    public function render()
    {
        return view('livewire.personal-profile-component');
    }
}