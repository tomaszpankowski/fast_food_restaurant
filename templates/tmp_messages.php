<?php

DatabaseConnect();
$messages = new TMessage($GLOBALS['connection']);

if(isset($_POST["msgdelete"])){
    $messages->deleteMessage(htmlspecialchars($_POST["msgdelete"]));
}

if(isset($_POST["msearch"])){
    $taggedRes = $messages->getByTag($_POST["msearch"]);
}


//handling messages list pagination
if(!isset($_SESSION["CurrentPage"])){
    $_SESSION["CurrentPage"]=1;
}
else{
    if(isset($_POST["prevpage"])
    && $_SESSION["CurrentPage"]>1){
        $_SESSION["CurrentPage"]--;
    }    
    if(isset($_POST["msearch"])){
        if(isset($_POST["nextpage"])
        && $_SESSION["CurrentPage"]<(ceil(count($taggedRes)/PAGE_SIZE))){
            $_SESSION["CurrentPage"]++;
        }
    }
    else{
        if(isset($_POST["nextpage"])
        && $_SESSION["CurrentPage"]<(ceil($messages->getListLength()/PAGE_SIZE))){
            $_SESSION["CurrentPage"]++;
        }
    }
}

?>

<section class="login-s1 container-fluid d-flex align-items-top bg-secondary py-5 minh-100vh">
    <form action=""
        autocomplete="off"
        class="form-user w-100"
        method="post">
        <div class="row mx-0 w-100 pt-5 mt-5">
            <div class="col-12 col-sm-4 col-md-3 mb-3">
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
                <div class="card w-100 mb-3">
                    <div class="card-body">
                        <label class="">Find message</label>
                        <div class="input-group">
                            <input class="form-control text-center"
                                name="msearch"
                                tabindex="1"
                                type="text">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark"
                                    name="msgsearch"
                                    tabindex="2"
                                    type="submit">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group float-left mb-2">
                    <button class="btn btn-sm btn-light"
                        name="messages"
                        type="submit">
                        Show All
                    </button>
                </div>
                <div class="btn-group float-right mb-2">
                    <button class="btn btn-sm btn-light"
                        name="prevpage"
                        type="submit">
                        &lt;
                    </button>
                    <button class="btn btn-sm btn-light"                        
                        disabled>
                        <?php     
                            if(isset($_POST["msearch"])){
                                if(isset($_SESSION["CurrentPage"])){
                                    echo $_SESSION["CurrentPage"]." / ".ceil(count($taggedRes)/PAGE_SIZE);
                                } 
                            }
                            else{
                                if(isset($_SESSION["CurrentPage"])){
                                    echo $_SESSION["CurrentPage"]." / ".ceil($messages->getListLength()/PAGE_SIZE);
                                }     
                            }                            
                        ?>
                    </button>
                    <button class="btn btn-sm btn-light"
                        name="nextpage"
                        type="submit">
                        &gt;
                    </button>
                </div>
                <div class="card w-100">
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped m-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_POST["msearch"])){
                                        $tab = $taggedRes;
                                    }
                                    else{    
                                        $tab = $messages->getList();
                                    }
                                    $pstart = ($_SESSION["CurrentPage"]-1)*PAGE_SIZE;
                                    $pend = $pstart+(PAGE_SIZE);
                                    for($i=$pstart;$i<count($tab) && $i<$pend;$i++){
                                        echo "<tr>".
                                            "<td>".$tab[$i]["id"]."</td>".
                                            "<td>".ucwords($tab[$i]["firstname"])." ".
                                            ucwords($tab[$i]["lastname"])."</td>".
                                            "<td>".
                                            substr($tab[$i]["time"],8,2).
                                            "-".
                                            substr($tab[$i]["time"],5,2).
                                            "-".
                                            substr($tab[$i]["time"],2,2).
                                            "</td>".
                                            "<td class='pl-0 pr-1'>".
                                            "<button type='submit' name='msgdelete' class='btn btn-sm btn-secondary float-right' value='".$tab[$i][0]."'>X</button>".
                                            "<button type='submit' name='msginfo' class='btn btn-sm btn-outline-secondary float-right px-3 mr-1' value='".$tab[$i][0]."'>i</button>".                                            
                                            "</td></tr>";
                                    }
                                ?>    
                            </tbody>
                        </table>                
                    </div> 
                </div>                   
                <div class="btn-group float-right mt-2">
                    <button class="btn btn-sm btn-light"
                        name="prevpage"
                        type="submit">
                        &lt;
                    </button>
                    <button class="btn btn-sm btn-light"                        
                        disabled>
                        <?php 
                            if(isset($_SESSION["CurrentPage"])){
                                echo $_SESSION["CurrentPage"]." / ".ceil($messages->getListLength()/PAGE_SIZE);
                            } 
                        ?>
                    </button>
                    <button class="btn btn-sm btn-light"
                        name="nextpage"
                        type="submit">
                        &gt;
                    </button>
                </div>
            </div>
        </div>
    </form>
</section>    