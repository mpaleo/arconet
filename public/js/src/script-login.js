$(".form-signin").submit(function(event) {
    event.preventDefault();
    $.post("/login", $(".form-signin").serialize(), function(data) {
        if(data.code == "0")
        {
            window.location.href = "/";
        }
        else if(data.code == "1")
        {
            $(".alert").fadeIn("slow");
        }
        else
        {
            console.log("Login error");
        }
    });
});