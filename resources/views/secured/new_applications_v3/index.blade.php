<div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                      <button class="btn btn-primary" onclick="next(1)">Next</button>
                    </div>
                    <script>
                      function next(num)
                      {
                        username = $("#exampleInputEmail1").val();
                        if(username == '')
                        {
                          alert('ERROR');

                        } else {
                          stepper.next()
                        }
                      }
                    </script>