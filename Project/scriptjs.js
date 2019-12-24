var name;

$(document).ready(function(){
   
    //country select
    
    $("#country").change(function(){
        
    

        //remove the dynamic options
        removeAllstate();

        //get country array from json 
        var country={
            Australia:['south austalia','western australia'],
            India:['Tamilnadu','kerala','goa','gujarat','haryana'],
            Afghanistan:['Kabul','Kandahar','Herat','Mazar-i-Sharif','Kunduz'],
            Albania:['Berat','Gramsh','Lezhe','Devoll','Kolonje'],
            Algeria:['Angola','Benin','Botswana'],
            Andorra:['Canillo','Encamp','Escaldes-Engordany','La Massana']
                 
        };
        
        mystate(country);

    })

    
   
}
)


//insert the options dynamically 
function mystate(country){

    var y=country[$("#country").val()];
    //alert("you clicked "+y.length);
    
    var z = document.getElementById("state");
    for(var key=0;key < y.length; key++)
    {
    z.options[z.options.length] = new Option(y[key],y[key]);
    }
}



function removeAllstate(){
    var select = document.getElementById("state");
    select.options.length = 0;
}


