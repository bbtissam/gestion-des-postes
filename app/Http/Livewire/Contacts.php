<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Contacts extends Component

{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $name;
    public $phone;
    public $photo;
    public $contacts;
    public $contactID;
    public $editing=false; 


    public $showData = true;
    public $createData = false;

    protected $rules=[
        'name'=>"required||min:3",
        'phone'=>"required",
        'photo' => 'image|max:1024', // 1MB Max

    ];

    protected $messages = [
        'name.required' => 'le champ nom est obligatoire',
        'phone.required' => 'le champ nom est obligatoire',
        'photo.image' => 'le fichier n\'est pas valide',

    ];

    

    public function getContacts(){
        $contacts=Contact::latest()->get();
        $this->contacts=$contacts;
    }

    
    public function savePhoto(){
        $this->photo->storeAs('photos',$this->photo->getClientOriginalName(),'public');
        return $this->photo->getClientOriginalName();
    }
   
    public function addContact(){
       $this->validate();
       $newContact=new Contact();
       $newContact->name=$this->name;
       $newContact->phone=$this->phone;
       $newContact->photo=$this->savePhoto();
       $newContact->save();
       $this->contacts->prepend($newContact);
       $this->name="";
       $this->phone="";
       $this->photo="";
       
       session()->flash('message', 'Contact successfully added.');
    }
    
    
    public function getContact($contactID){
        $contact=Contact::find($contactID);
        $this->contactID=$contact->id;
        $this->name=$contact->name;
        $this->phone=$contact->phone;
        
            //$this->photo=$contact->photo;
        
        $this->editing=true;
    }

    public function updateContact(){
        $this->validate([
            'name'=>"required||min:3",
        'phone'=>"required",
        ]);
        $contact=Contact::find($this->contactID);
        $contact->name=$this->name;
        $contact->phone=$this->phone;
        if($this->photo){
            $this->validate([
                'photo'=>'image|max:1024'
            ]);
            $contact->photo=$this->savePhoto();
        }
        $contact->update();
        $this->getContacts();
        $this->name="";
        $this->phone="";
        $this->photo="";
        $this->contactID="";
        $this->editing=false;
        session()->flash('message', 'Contact successfully updated.');

     }

    public function cancelUpdate(){
        $this->name="";
        $this->phone="";
        $this->photo="";
        $this->contactID="";
        $this->editing=false;
    }

    public function deleteContact($contactID){
        $contact=Contact::find($contactID);
         if(File::exists(public_path('./storage/photos/'.$contact->photo))){
            File::delete(public_path('./storage/photos/'.$contact->photo));
         }
        $contact->delete();
        $this->contacts=$this->contacts->except($contactID);
        session()->flash('message', 'Contact successfully deleted.');

        
    }
    public function mount(){
        $this->getContacts();
    }

    public function render()
    {
        return view('livewire.contacts')->with(['contactsList'=>Contact::latest()->paginate(4)]);
    }
}
