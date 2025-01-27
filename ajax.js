let searchForm = document.getElementById('event2');
let searchInput = document.getElementById('eventtypeajax');
let response = document.getElementById('ville');

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
            for(const data of datas){
                const liData = document.createElement("option");
                liData.setAttribute('value', data.ville_nom);
                liData.innerText = data.ville_nom;
                response.append(liData);
            }
            
            
        })
    }
});