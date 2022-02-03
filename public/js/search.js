const search = document.querySelector(".name-search");
const searchLocation = document.querySelector(".location");
    const articleContainer = document.querySelector('.categories');

    search.addEventListener("keyup", function(event) {
        if(event.key === "Enter") {
            event.preventDefault();

            const data = {search: this.value};

            fetch("/search", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(function (response) {
                return response.json();
            }).then(function(articles) {
                articleContainer.innerHTML = "";
                loadArticles(articles);
            })

        }
    });

searchLocation.addEventListener("keyup", function(event) {
    if(event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function(articles) {
            articleContainer.innerHTML = "";
            loadArticles(articles);
        })

    }
});

    function loadArticles(articles) {
        articles.forEach(article => {
            console.log(article);
            createArticle(article);
        })
    }

    function  createArticle(article) {
        const template = document.querySelector("#template");

        const clone = template.content.cloneNode(true);
        const div = clone.querySelector("div");
        div.id = article.id;

        const image = clone.querySelector("img");
        image.src = `public/img/form-images/${article.img}`;
        const title = clone.querySelector("h2");
        title.innerHTML = article.title;
        const price = clone.querySelector("#price");
        price.innerHTML = article.price;
        const location = clone.querySelector("#location");
        location.innerHTML = article.location;

        articleContainer.appendChild(clone);
    }