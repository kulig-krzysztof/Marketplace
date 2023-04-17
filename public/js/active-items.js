
const button = document.querySelectorAll('#form > button');
const editDiv = document.querySelectorAll('#option-edit');
const offersDiv = document.querySelectorAll('#option-offers');
//const itemData = document.querySelector('#item-data');

/*
button.forEach(function(element,index) {
    element.addEventListener("mouseover", function () {
        let actionField = element.querySelector('#action-field');
        let itemData = element.querySelector('#item-data');
        actionField.style.display = "flex";
        itemData.style.display = "none";
    });
});

button.forEach(function(element,index) {
    element.addEventListener("mouseout", function () {
        let actionField = element.querySelector('#action-field');
        let itemData = element.querySelector('#item-data');
        actionField.style.display = "none";
        itemData.style.display = "flex";
    });
});



editDiv.forEach(function(element) {
    element.addEventListener("click", function () {
        const form = document.querySelector('#form');
        const formData = new FormData(form);
        formData.append('item-id', element.className);
        console.log(element.className);

        fetch('updateItemSite', {
            method: 'POST',
            body: formData,
        })
            .then((response) => {
                return response.text();
            })
            .then((data) => {
                console.log(data);
                document.documentElement.innerHTML = data;
            })
            .catch((error) => {
                if (error.message) {
                    console.error(error.message);
                } else {
                    console.error(error);
                }
            });
    });
})
/*
editDiv.addEventListener("click", function () {
    const form = document.querySelector('#form');
    const formData = new FormData(form);
    formData.append('item-id', editDiv.className);
    console.log(editDiv.className);

    fetch('updateItemSite', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.error(error);
        });
});

        /*

        document.body.appendChild(topDiv);
        topDiv.id = "topDiv";
        topDiv.style.position = 'absolute';
        topDiv.style.top = 0;
        topDiv.style.left = 0;
        topDiv.style.width = element.width;
        topDiv.style.height = element.height;
        topDiv.style.backgroundColor = 'red';



        //element.disabled = "true";
        element.style.opacity = "0.2";
        let offersButton = document.createElement("button");
        offersButton.id = element.id;
        offersButton.value = element.value;
        offersButton.className = "offersButton";
        offersButton.name = "Oferty";
        offersButton.innerHTML = "Oferty";
        offersButton.formMethod = "POST";
        offersButton.formAction = "updateItemSite";
        offersButton.style.position = "absolute";
        offersButton.style.transform = "translate(200%, 200%)";
        offersButton.style.opacity = "1";
        topDiv.appendChild(offersButton);


        let editButton = document.createElement("button");
        editButton.id = element.id;
        editButton.value = element.value;
        editButton.className = "editButton";
        editButton.name = "Edytuj";
        editButton.innerHTML = "Edytuj";
        editButton.formMethod = "GET";
        editButton.formAction = "dupa";
        editButton.style.position = "absolute";
        editButton.style.transform = "translate(50%, 50%)";
        editButton.style.opacity = "1";
        topDiv.appendChild(editButton);
    });
});

div.forEach(function(element) {
   topDiv.addEventListener("mouseout", function() {
        element.style.opacity = "1";
        let offersButton = document.querySelector(".offersButton");
        let editButton = document.querySelector(".editButton");
        offersButton.remove();
        editButton.remove();
        document.body.removeChild(topDiv);
    });
});


/*
div.forEach(function(element,index) {
    document.body.addEventListener("mouseout", function () {
        element.style.opacity = "1";
        let offersButton = document.querySelector(".offersButton");
        let editButton = document.querySelector(".editButton");
        element.removeChild(offersButton);
        editButton.remove();
        //document.body.removeChild(topDiv);
    });
});
 */

