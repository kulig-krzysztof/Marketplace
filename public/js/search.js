const search = document.querySelector(".name-search");
const searchLocation = document.querySelector(".location");
const articleContainer = document.querySelector('.categories');

if(search) {
    search.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
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
            }).then(function (items) {
                articleContainer.innerHTML = "";
                loadArticles(items);
            })

        }
    });
}

if(searchLocation) {
    searchLocation.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
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
            }).then(function (items) {
                articleContainer.innerHTML = "";
                loadArticles(items);
            })

        }
    });
}



    function loadArticles(items) {
        items.forEach(item => {
            console.log(item);
            createArticle(item);
        })
    }

    function  createArticle(item) {
        const template = document.querySelector("#template");

        const clone = template.content.cloneNode(true);
        const button = clone.querySelector("button");
        button.id = item.id;
        button.value = item.id;

        const image = clone.querySelector("img");
        image.src = `public/img/form-images/${item.img}`;
        const title = clone.querySelector("h2");
        title.innerHTML = item.title;
        const price = clone.querySelector("#price");
        price.innerHTML = "Cena: " + item.price + " zł";
        const location = clone.querySelector("#location");
        location.innerHTML = "Lokalizacja: " + item.city_name;

        articleContainer.appendChild(clone);
    }