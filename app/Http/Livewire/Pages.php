<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\withPagination;

class Pages extends Component
{
    use withPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;
    
    /**
     * form validatoin rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title'=> 'required',
            'slug'=>['required', Rule::unique('pages', 'slug')->ignore( $this->modelId ) ],
            'content'=>'required',
        ];
    }
    
    /**
     * the livewire mount function.
     *
     * @return void
     */
    public function mount()
    {
        // reset the pagination after reload the page
        $this->resetPage();
    }

    public function pr($el)
    {
        echo '<pre>';
         print_r($el);
        echo '</pre>';
    }
    /**
     * run everytime the title is updated 
     * in the slug.
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value)
    {
        $this->genrateSlug($value);
    }

    /**
     * create function 
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    
    /**
     * The read function
     *
     * @return void
     */
    public function read()
    {
        return Page::paginate(5);
    }
    
    /**
     * show the form modal 
     * of the create function 
     * @return void
     */
    public function createShowModal(){

        $this->resetVars();    
        $this->modalFormVisible = true;
    
    }

    
    /**
     * update post functionality
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModal();
    }    

    
    /**
     * show the delete show modal 
     * in the form.
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal( $id )
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }


    
    /**
     * the delete function.
     *
     * @return void
     */
    public function delete()
    {
        Page::destroy( $this->modelId );
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }
        
    /**
     * load model data of this
     * component.
     *
     * @return void
     */
    public function loadModal()
    {
        $data = Page::find( $this->modelId );
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;

    }


    public function update()
    {
        $this->validate();
        Page::find( $this->modelId )->update( $this->modelData() );
        $this->resetVars();
        $this->modalFormVisible = false;
    }
    
    /**
     * The data for the model mapped 
     * in this component
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'title'=> $this->title,
            'slug'=> $this->slug,
            'content'=> $this->content,
        ];
    }
        
    /**
     * genrate the url slug
     * from the title.
     *
     * @param  mixed $value
     * @return void
     */
    public function genrateSlug($value)
    {
        $process1 = str_replace(' ', '-', $value );
        $process2 = strtolower($process1);
        $this->slug = $process2;

    }
    /**
     * clear model form varibles 
     * from the component 
     *
     * @return void
     */
    public function resetVars()
    {
        $this->modelId = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }

    /**
     * livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
            ]);
    }
}
