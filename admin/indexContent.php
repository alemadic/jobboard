

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Welcome to Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">

              </div>

            </div>
          </div>

          <h2 id="pageTitle">Select want you want to CRUD</h2>
          <div class="table-responsive" id="mainContent">

          </div>

          <div id="insertJobCont">
          
            <a href="#" class="btn btn-light mb-5" id="addNew">Add new</a>

            <div id="insertJob" class="d-none">
            
            <form action="insertJob.php" method="POST" class="forma" id="editForm" onSubmit="return proveraEdit();">
                  <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Job Title" value="" />

                

                  <select class="form-control mb-3" id="firme" name="firme">
                      <option value="0">Company</option>

                  </select>

                  <select class="form-control mb-3" id="kategorije" name="kategorije">
                      <option value="0">Category</option>

                  </select>

                  <input type="date" class="form-control" id="date" name="date" placeholder="Deadline: mm/dd/yy" value="" />

                  <select class="form-control" id="lokacije" name="lokacije">
                      <option value="0">Location</option>

                  </select>

                  <select class="form-control mb-3" id="iskustvo" name="iskustvo">
                      <option value="0">Experience</option>

                  </select>

                  <select class="form-control mb-3" id="tipPosla" name="tipPosla">
                      <option value="0">Job type</option>

                  </select>

                  <input class="form-control" type="number" id="plata" name="plata" placeholder="Salary"  />

                  <textarea name="jobDesc" id="jobDesc" rows="7" placeholder="Job description" class="form-control"></textarea>

                  <input type="submit" class="btn btn-primary mt-4" name="submitInsert" value="Submit Edit" />
              </form>
            </div>
          </div>

          <div id="insertKatCont">

            <a href="#" class="btn btn-light mb-5" id="addNewKat">Add new</a>

            <div id="insertKat" class="mb-5 d-none">
              <form action="insertKat.php" class="forma" method="POST" onSubmit="return proveraKat();">
                <input type="text" id="katNaziv" name="katNaziv" class="form-control" placeholder ="Category Name"/>

                <input type="number" id="popular" name="popular" class="form-control" placeholder="Popularity 1/0" />

                <input type="submit" class="btn btn-primary mt-4" name="submitInsertKat" value="Submit" />
              </form>
            
            </div>


          </div>
          

        </main>
      </div>
    </div>




