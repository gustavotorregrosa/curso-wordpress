class Search {
    constructor() {
        this.addSearchHTML();

        this.resultsDiv = $("#search-overlay__results");
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.isAberto = false;
        this.typingTimer;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.events();


    }

    events() {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keyup", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));

    }

    getResults() {
        $.getJSON('http://localhost/wordpress/wp-json/university/v1/search?key=' + this.searchField.val(), (results) => {
            this.resultsDiv.html(`
                <div class="row">
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">General Information</h2>
                        ${results.generalInfo.length ? ' <ul class="link-list min=list">' : '<p>Nenhum resultado encontrado</p>'}
                            ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''} </li>`).join('')}
                        ${results.generalInfo.length ? '</ul>' : ''}

                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Programs</h2>
                        ${results.programs.length ? ' <ul class="link-list min=list">' : `<p>Nenhum resultado encontrado <a href="programs">Veja todos os programas</a></p>`}
                             ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${results.programs.length ? '</ul>' : ''}
                       
                        <h2 class="search-overlay__section-title">Professors</h2>
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Campi</h2>
                        ${results.campi.length ? ' <ul class="link-list min=list">' : '<p>Nenhum resultado encontrado</p>'}
                             ${results.campi.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${results.campi.length ? '</ul>' : ''}
                        <h2 class="search-overlay__section-title">Events</h2>
                    </div>
                </div>
            
            `);
            this.isSpinnerVisible = false;
        });
        



        //deletar
        // $.when(
        //     $.getJSON('http://localhost/wordpress/wp-json/wp/v2/posts?search=' + this.searchField.val()),
        //     $.getJSON('http://localhost/wordpress/wp-json/wp/v2/pages?search=' + this.searchField.val())
        // ).then((posts, pages) => {
        //     var combinedResults = posts[0].concat(pages[0]);

        //     this.resultsDiv.html(`
        
        //     <h2 class="search-overlay__section-title">General Info</h2>
        //     ${combinedResults.length ? ' <ul class="link-list min=list">' : '<p>Nenhum resultado encontrado</p>'}
        //         ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `by ${item.authorName}` : ''} </li>`).join('')}
        //     ${combinedResults.length ? '</ul>' : ''}
            
        
        //     `);
        //     this.isSpinnerVisible = false;
        // }, () => {
        //     this.resultsDiv.html('<p>Erro inesperado</p>');
        // });




        // $.getJSON('http://localhost/wordpress/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
        //     $.getJSON('http://localhost/wordpress/wp-json/wp/v2/pages?search=' + this.searchField.val(), pages => {

        //     });
        // });



    }

    typingLogic() {
        if (this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);
            if (this.searchField.val() != "") {
                if (!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }

                this.typingTimer = setTimeout(this.getResults.bind(this), 750);

            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;

            }

        }
        this.previousValue = this.searchField.val();

    }

    keyPressDispatcher(e) {
        // console.log(e.keyCode);
        if (e.keyCode == 83 && !this.isAberto) {
            this.openOverlay();
        }
        if (e.keyCode == 27 && this.isAberto) {
            this.closeOverlay();
        }

    }

    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");

        $("body").addClass("body-no-scroll");
        this.isAberto = true;
        this.searchField.val("");
        setTimeout(function () {
            this.searchField.focus();
        }.bind(this), 400);

    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isAberto = false;
    }

    addSearchHTML() {
        $("body").append(`
        
<div class="search-overlay">
<div class="search-overlay__top">
  <div class="container">
    <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
    <input type="text" class="search-term" placeholder="what are you looking for?" id="search-term">
    <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
  </div>
</div>

<div class="container">
  <div id="search-overlay__results">

  
  </div>
</div>

</div>

        
        `);
    }

}


var busca = new Search();