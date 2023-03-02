window.addEventListener('load', function() {
    var parentMenuItem = document.querySelectorAll('#spine-sitenav .parent > a');
    var parentMenuText = [];
    var closestParentDefault = [];
   
    //Removes href from parent link
    for( var x=0; x < parentMenuItem.length; x++){
        parentMenuItem[x].href = "#";
        
    }

    
    function changeAriaExpanded(e){

        var menuItem = e.currentTarget;

        var closestParent = menuItem.closest('.parent');
        var openedClass = closestParent.classList.contains('opened');

        parentMenuText = menuItem.innerText;
        if ( openedClass == true){
            menuItem.ariaExpanded = "true";
            menuItem.ariaLabel = "Close submenu for "+parentMenuText;
        }else {
            menuItem.ariaExpanded = "false";
            menuItem.ariaLabel = "Open submenu for "+parentMenuText;
        }

        console.log(openedClass);
    }


    //Adds aria label to parent menu item that lets user know it will open a submenu
    for( var i=0; i < parentMenuItem.length; i++){
        parentMenuText[i] = parentMenuItem[i].innerText;

        closestParentDefault[i] = parentMenuItem[i].closest('.parent');

        var openedClasstest = closestParentDefault[i].classList.contains('opened');
        
        if(openedClasstest == true){
            parentMenuItem[i].ariaExpanded = "true";
            parentMenuItem[i].ariaLabel = "Close submenu for "+parentMenuText[i];
        }else{
            parentMenuItem[i].ariaExpanded = "false";
            parentMenuItem[i].ariaLabel = "Open submenu for "+parentMenuText[i];
        }

        
        parentMenuItem[i].addEventListener('click',changeAriaExpanded);
    }

});