class MyNotes {
    constructor(){
        this.events();
        
    }

    events(){
        $("#my-notes").on("click", ".delete-note" , this.deleteNote);
        $("#my-notes").on("click", ".edit-note" ,this.editNote.bind(this));
        $("#my-notes").on("click", ".update-note", this.updateNote.bind(this));
        $(".submit-note").on("click", this.createNote.bind(this));
    }

    editNote(e){
        var thisNote = $(e.target).parents("li");
        if(thisNote.data("state") == 'editable'){
            this.makeNoteReadOnly(thisNote);
        }else{
            this.makeNoteEditable(thisNote);
        }
       
    }


    

    makeNoteEditable(thisNote){
        thisNote.find(".edit-note").html('<i class="fa fa-times" aria-hidden="true">Cancel</i>');
        thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");
        thisNote.find(".update-note").addClass("update-note--visible");
        thisNote.data("state", "editable");
    }

    makeNoteReadOnly(thisNote){
        thisNote.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true">Edit</i>');
        thisNote.find(".note-title-field, .note-body-field").attr("readonly", "readonly").removeClass("note-active-field");
        thisNote.find(".update-note").removeClass("update-note--visible");
        thisNote.data("state", "readonly");

    }

    createNote(e){
       
        var ourNewPost = {
            'title': $(".new-note-title").val(),
            'content': $(".new-note-body").val(),
            'status': 'private'
        }
        
        $.ajax({

            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/',
            type: 'post',
            data: ourNewPost,
            success: (response) => {
                $(".new-note-title, .new-note-body").val("");
                $(`
                <li data-state="readonly" data-id="${response.id}">
                    <input readonly class="note-title-field" type="text" value="${response.title.raw}">
                    <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true">Edit</i></span>
                    <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true">Delete</i></span>
                    <textarea readonly class="note-body-field" name="" id="" cols="30" rows="10">
                        ${response.content.raw}
                    </textarea>
                    <span class="update-note btn btn--blue btn--smal"><i class="fa fa-arrow-right" aria-hidden="true">Save</i></span>
                </li>
                
                `).prependTo("#my-notes").hide().slideDown();
                


                console.log("oba!");
                console.log(response);
            },
            error: (response) => {
                if(response.responseText == "\nyou have reached your note limit"){
                    $(".note-limit-message").addClass("active");
                }
                console.log("sorry");
                console.log(response);
            }

        });
    }


    updateNote(e){
        var thisNote = $(e.target).parents("li");
        var ourUpdatedPost = {
            'title': thisNote.find(".note-title-field").val(),
            'content': thisNote.find(".note-body-field").val()
        }
        
        $.ajax({

            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'post',
            data: ourUpdatedPost,
            success: (response) => {
                this.makeNoteReadOnly(thisNote);
                console.log("oba!");
                console.log(response);
            },
            error: (response) => {
                console.log("sorry");
                console.log(response);
            }

        });
    }
    

    deleteNote(e){
        var thisNote = $(e.target).parents("li");
        
        $.ajax({

            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'delete',
            success: (response) => {
                thisNote.slideUp();
                console.log("oba!");
                console.log(response);
                if(response.userNoteCount < 5){
                    $(".note-limit-message").removeClass("active");
                }
            },
            error: (response) => {
                console.log("sorry");
                console.log(response);
            }

        });
    }
}

notas = new MyNotes();