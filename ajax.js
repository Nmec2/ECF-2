let searchForm = document.getElementById('event2');
let searchInput = document.getElementById('eventtypeajax');
console.log(searchInput);
console.log(searchForm);

let response = document.getElementById('ville');
console.log(response);

searchInput.addEventListener('input', function(){
    response.innerHTML = "";
    if (searchInput.value.length >= 2 ) {
        let formData = new FormData(searchForm);
        fetch('requete.php', {
            method: 'POST',
            body: formData
        })
        .then((datas) => datas.json())
        .then((datas) => {
            // const ulData = document.getElementsByTagName('datalist');
            // response.append(ulData);
            for(const data of datas){
                const liData = document.createElement("option");
                liData.setAttribute('value', data.ville_nom);
                liData.innerText = data.ville_nom;
                response.append(liData);
            }
            
            
        })
    }
});