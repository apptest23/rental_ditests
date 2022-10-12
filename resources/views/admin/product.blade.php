@extends('admin.layouts.header')

@section('content')

 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="dashboard.html">Home</a>
            </li>
            <li>
               <a href="index.html"><span>Product List</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Home Page Product List</h4>
            <button class="btn1"><a href="add.html" style="color:white;">ADD</a></button>
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                  <div class="sear-main">
                     <label><input type="search" class="form-control " placeholder="Find..."></label>
                  </div>
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                     <th>Vender Name</th>
                     <th>Image</th>
                     <th>Tittle</th>
                     <th>Category</th>
                     <th>Days</th>
                     <th>price</th> 
                     <th>Edit/Delete</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                        <th>xyz</th>
                        <td>
                          <img src="image/product-23.png" width="60" height="60">
                        </td>
                        <td>Sewing Machines</td>
                        <td>Electronics</td>
                        <td>1</td>
                        <td>340</td>
                        <td>
                          <a class="icon__1" href="edit.html"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td>
                    </tr>
               </tbody>
               <tbody>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                        <th>xyz</th>
                        <td>
                          <img src="image/product-06.jpg" width="60" height="60">
                        </td>
                        <td>kurta</td>
                        <td>Men</td>
                        <td>1</td>
                        <td>500</td>
                        <td>
                          <a class="icon__1" href="edit.html"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td>
                    </tr>
               </tbody>
               <tbody>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                        <th>xyz</th>
                        <td>
                          <img src="image/product-20.jpg" width="60" height="60">
                        </td>
                        <td>Bride Grown</td>
                        <td>Women</td>
                        <td>1</td>
                        <td>340</td>
                        <td>
                           <a class="icon__1" href="edit.html"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td>
                    </tr>
               </tbody>
               <tbody>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                        <th>xyz</th>
                        <td>
                          <img src="image/product-12.jpg" width="60" height="60">
                        </td>
                        <td>Wedding Chairs</td>
                        <td>Marriage Events</td>
                        <td>1</td>
                        <td>300</td>
                        <td>
                          <a class="icon__1" href="edit.html"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td>
                    </tr>
               </tbody>
               <tbody>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                        <th>xyz</th>
                        <td>
                          <img src="image/product-3.png" width="60" height="60">
                        </td>
                        <td>Microwave Oven</td>
                        <td>Electronics</td>
                        <td>1</td>
                        <td>340</td>
                        <td>
                          <a class="icon__1" href="edit.html"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td>
                    </tr>
               </tbody>
               <tbody>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                        <th>xyz</th>
                        <td>
                          <img src="image/product-10.jpg" width="60" height="60">
                        </td>
                        <td>Wedding Sofa</td>
                        <td>Marriage Events</td>
                        <td>1</td>
                        <td>600</td>
                        <td>
                          <a class="icon__1" href="edit.html"><i class="fas fa-edit"></i></a>
                           <a class="icon__2" href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td>
                    </tr>
               </tbody>
            </table>
            <div class="product-filter product-filter1">
                <div class="row row1">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="showing">
                            <p>Showing 1 to 6 of 12 (1 Pages)</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fal fa-angle-left"></i></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link active" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">...</li>
                            <li class="page-item">
                                <a class="page-link" href="#">10</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fal fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
         </div>
      </div>

      @endsection