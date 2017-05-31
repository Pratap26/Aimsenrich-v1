
function dynamicdropdown(listindex)
    {
        document.getElementById("subcategory").length = 0;
        var x=document.getElementById("subcategory");
        x.disabled=false
        switch (listindex)
            {
             case "semester" :
                document.getElementById("subcategory").options[0]=new Option("select course structure","");
                for(var i=0; i<6;i++)
                document.getElementById("subcategory").options[i+1]=new Option(i+1,i+1);
                break;
                    
            case "standerd" :
                document.getElementById("subcategory").options[0]=new Option("select course structure","");
                document.getElementById("subcategory").options[1]=new Option("Days","Days");
                document.getElementById("subcategory").options[2]=new Option("Month","Month");
                break;
            }
        return true;
    }
function dynamic(listindex)
    {
        document.getElementById("subcategory2").length = 0;
        var x=document.getElementById("subcategory2");
        x.disabled=false
        switch (listindex)
        {
        case "Days" :
            document.getElementById("subcategory2").options[0]=new Option("select number of days","");
            for(var i=0; i<31;i++)
            document.getElementById("subcategory2").options[i+1]=new Option(i+1,i+1);
            break;
                    
        case "Month" :
            document.getElementById("subcategory2").options[0]=new Option("select number of month","");
            for(var i=0; i<12;i++)
            document.getElementById("subcategory2").options[i+1]=new Option(i+1,i+1);
            break;
        case "1" :
        case "2" :
        case "3" :
        case "4" :
        case "5" :
        case "6" :
            document.getElementById("subcategory2").options[0]=new Option("select number of year","");
            document.getElementById("subcategory2").options[1]=new Option("1","1");
            document.getElementById("subcategory2").options[2]=new Option("2","2");
            document.getElementById("subcategory2").options[3]=new Option("3","3");
            document.getElementById("subcategory2").options[4]=new Option("4","4");
            break;
        }
    return true;
    }