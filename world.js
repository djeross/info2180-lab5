window.addEventListener('click',()=>{

    document.querySelector('#lookup').addEventListener('click',(e)=>{
        e.preventDefault();
        let country_req=document.querySelector("#country").value.replace( /(<([^>]+)>)/ig, '');
        let url="http://localhost/info2180-lab5/world.php"+"?country="+country_req;

        fetch(url)
        .then((response)=>{
            if(response.ok){
                return response.text();
            }
            else{
                Promise.reject("Error in retrieving data");
            }
        })
        .then((data)=>{
            document.querySelector('#result').innerHTML=data; 
        })
        .catch(error=>{
            alert("error in retrieving data");
        });
    });

    document.querySelector('#cities').addEventListener('click',(e)=>{
        e.preventDefault();
        let cities_req=document.querySelector("#country").value.replace( /(<([^>]+)>)/ig, '');
        let url="http://localhost/info2180-lab5/world.php"+"?country="+cities_req+"&context=cities";

        fetch(url)
        .then((response)=>{
            if(response.ok){
                return response.text();
            }
            else{
                Promise.reject("Error in retrieving data");
            }
        })
        .then((data)=>{
            document.querySelector('#result').innerHTML=data;  
        })
        .catch(error=>{
            alert("error in retrieving data");
        });
    });

});