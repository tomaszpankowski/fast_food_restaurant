<section class="login-s1 container-fluid d-flex align-items-top bg-secondary py-5 minh-100vh">
    <form action=""
        autocomplete="off"
        class="form-user w-100"
        method="post">
        <div class="row mx-0 w-100 pt-5 mt-5">
            <div class="col-12 col-sm-4 col-md-3">
                <div class="list-group">
                    <input class="list-group-item list-group-item-action"
                        name="dashboard"
                        type="submit"
                        value="Dashboard">  
                    <input class="list-group-item list-group-item-action"
                        name="messages"
                        type="submit"
                        value="Messages">     
                    <?php 
                        if(isset($_SESSION["UserLogged"])
                        && $_SESSION["UserLogged"]==="administrator"){
                    ?>                      
                    <input class="list-group-item list-group-item-action"
                        name="users"
                        type="submit"
                        value="Users">          
                    <?php } ?>                 
                    <input class="list-group-item list-group-item-action"
                        name="logout"
                        type="submit"                                
                        value="Logout">
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-9">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <small class="text-muted">Dashboard</small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>    