function dashboardAccessControl(){
    let access_level = parseInt(document.getElementById("access-level").innerHTML);
    if(access_level === 4){
        folder_edit = document.querySelectorAll(".utility-btn-3 .folder-edit-btn");
        folder_delete = document.querySelectorAll(".utility-btn-3 .folder-delete-btn");
        folder_add = document.querySelector(".add-folder-btn");
        property_image_add = document.querySelector(".property-image-add");
        property_image_view = document.querySelector(".property-image-view");
        property_image_add.style.display = "none";
        property_image_view.style.display = "none";
        folder_add.style.display = "none";
        for(let i=0; i < folder_edit.length; i++){
            folder_edit[i].style.display = "none";
            folder_delete[i].style.display = "none";
        }
    }
}


function itemAccessControl(){
    let access_level = parseInt(document.getElementById("access-level").innerHTML);
    if(access_level === 4){
        item_edit = document.querySelectorAll(".utility-btn-3 .item-edit-btn");
        item_delete = document.querySelectorAll(".utility-btn-3 .item-delete-btn");
        for(let i=0; i < item_edit.length; i++){
            item_edit[i].style.display = "none";
            item_delete[i].style.display = "none";
        }   
    }
}


function itemImageAccessControl(){
    let access_level = parseInt(document.getElementById("access-level").innerHTML);
    if(access_level === 4){
        image_add = document.querySelector(".item-image-add");
        image_view = document.querySelector(".item-image-view");
        image_view.style.display = "none";
        image_add.style.display = "none";
    }
}

function itemMaintenanceAccessControl(){
    let access_level = parseInt(document.getElementById("access-level").innerHTML);
    if(access_level === 4){
        item_edit = document.querySelectorAll(".utility-btn-3 .item-edit-btn");
        item_delete = document.querySelectorAll(".utility-btn-3 .item-delete-btn");
        item_add = document.querySelector(".add-item-btn");
        item_add.style.display = "none";
        for(let i=0; i < item_edit.length; i++){
            item_edit[i].style.display = "none";
            item_delete[i].style.display = "none";
        }   
    }
}
