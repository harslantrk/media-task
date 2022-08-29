function deleteApprove(link) {
    swal({
                title: "Do you want to delete?",
                text: "If you delete, you can't reach this data anymore!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    swal("Deleted!", "Your data is succesfully deleted", "success");
                    location.href = link;
                } else {
                    swal("Cancel!", "Your data is still remaining.", "error");
                }
            });
}