class Like {
    constructor(){
        this.events();
        

    }

    events(){
        $(".like-box").on("click", this.ourClickDispatcher.bind(this));
    }

    ourClickDispatcher(e){
        var currentLikeBox = $(e.target).closest(".like-box");

        if(currentLikeBox.data("exists") == "yes"){
            this.deleteLike(currentLikeBox);
        }else{
            this.createLike(currentLikeBox);
        }

    }

    createLike(currentLikeBox){
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'post',
            data: {
                 'professorID': currentLikeBox.data("professor")
            },
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    deleteLike(){
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'delete',
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

}


meuLike = new Like();