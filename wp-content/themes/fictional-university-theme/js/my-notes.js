class MyNotes {
    constructor(){
        this.events();
        
    }

    events(){
        $(".delete-note").on("click", this.deleteNote);
    }


    deleteNote(){
        alert("ola mundo - notas");
    }
}

notas = new MyNotes();