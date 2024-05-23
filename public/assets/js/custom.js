$("#addUserForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 3,
            maxlength: 50
        },
        phone: {
            required: true,
            minlength: 10,
            maxlength: 10,
        },
        email: {
            required: true,
            email: true
        },
        description:{
            required: true,
            minlength: 10,
            maxlength: 200
        },
    },
    messages: {
        name: {
            required: "Name is required.",
            minlength: "Name must be at least 3 characters long.",
            maxlength: "Name must be less than 50 characters long."
        },
        description: {
            required: "Description is required.",
            minlength: "Description must be at least 10 characters long.",
            maxlength: "Description must be less than 200 characters long."
        },
        phone: {
            required: "Phone number is required.",
            minlength: "Phone number must be at least 10 digits long.",
            maxlength: "Phone number must be less than 10 digits long.",
            digits: "Phone number must contain only digits."
        },
        email: {
            required: "Email address is required.",
            email: "Please enter a valid email address."
        }
    },
    errorClass: "help-inline",
    errorElement: "span",
    highlight: function(element, errorClass, validClass) {
        $(element).closest('.control-group').addClass('error').removeClass('success');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).closest('.control-group').removeClass('error').addClass('success');
    }
});


 // Submit form if it's valid
 $("#addUserForm").submit(function(e) {
    e.preventDefault();
    if ($(this).valid()) {
        let formData = new FormData(this);
        axios.post('/api/users', formData)
            .then(response => {
                document.getElementById('errorContainer').style.display = 'none';
                alert("User created successfully");
                document.getElementById("addUserForm").reset();
                loadUsers();

            })
            .catch(error => {
                let errorMessage="";
                if (error.response && error.response.data.errors) {
                    const validationErrors = error.response.data.errors;
                    errorMessage += '\nValidation errors:\n' + Object.values(validationErrors).flat().join('\n');
                }
                const errorContainer = document.getElementById('errorContainer');
                errorContainer.innerText = errorMessage;
                errorContainer.style.display = 'block';
            });
    }
});


function loadUsers() {
    axios.get('/api/users')
        .then(response => {
            if(response.data.data.length){
                document.getElementById("add-user-form").style.display="none";
                document.getElementById("users-tabel-section").style.display="block";
            }else{
                document.getElementById("add-user-form").style.display="block";
                document.getElementById("users-tabel-section").style.display="none";
            }
            
            let usersTable = document.getElementById('usersTable').getElementsByTagName('tbody')[0];
            usersTable.innerHTML = '';
            response.data.data.forEach(user => {
                let row = usersTable.insertRow();
                row.insertCell(0).innerHTML = `<img src="${user.profile_image ?? 'https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1'}" width="50" height="50">` ;
                row.insertCell(1).innerText = user.name;
                row.insertCell(2).innerText = user.email;
                row.insertCell(3).innerText = user.phone;
                row.insertCell(4).innerText = user.role.name;
                row.insertCell(5).innerText = user.description;
            });
        })
        .catch(error => {
            console.error(error);
        });
}
loadUsers();


$("#add-user-btn").on("click",function(e) {
    document.getElementById("users-tabel-section").style.display="none";
    document.getElementById("add-user-form").style.display="block";

});

