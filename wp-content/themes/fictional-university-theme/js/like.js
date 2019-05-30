class Like {
    constructor(){
        this.events();
        

    }

    events(){
        $(".like-box").on("click", this.ourClickDispatcher.bind(this));
    }

    ourClickDispatcher(e){
        var currentLikeBox = $(e.target).closest(".like-box");

        if(currentLikeBox.attr("data-exists") == "yes"){
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
            // xhrFields: {
            //     withCredentials: true
            //  },
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            success: (response) => {
                currentLikeBox.attr('data-exists', 'yes');
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount++;
                currentLikeBox.find(".like-count").html(likeCount);
                currentLikeBox.attr('data-like', response);
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    deleteLike(currentLikeBox){
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            data: {
                'like': currentLikeBox.attr('data-like')
            },
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            type: 'delete',
            success: (response) => {
                currentLikeBox.attr('data-exists', 'no');
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount--;
                currentLikeBox.find(".like-count").html(likeCount);
                currentLikeBox.attr('data-like', '');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

}


meuLike = new Like();