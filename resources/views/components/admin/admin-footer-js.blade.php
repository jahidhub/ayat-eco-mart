 <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
 <!--plugins-->
 <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

 <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
 <script src="{{ asset('admin/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
 <script src="{{ asset('admin/assets/js/index.js') }}"></script>
 <script src="{{ asset('admin/assets/sweetalert2/dists/sweetalert2.all.min.js') }}"></script>
 <!--app JS-->
 <script src="{{ asset('admin/assets/js/app.js') }}"></script>


 <!--Password show & hide js -->
 <script>
     $(document).ready(function() {
         $("#show_hide_password a").on('click', function(event) {
             event.preventDefault();
             if ($('#show_hide_password input').attr("type") == "text") {
                 $('#show_hide_password input').attr('type', 'password');
                 $('#show_hide_password i').addClass("bx-hide");
                 $('#show_hide_password i').removeClass("bx-show");
             } else if ($('#show_hide_password input').attr("type") == "password") {
                 $('#show_hide_password input').attr('type', 'text');
                 $('#show_hide_password i').removeClass("bx-hide");
                 $('#show_hide_password i').addClass("bx-show");
             }
         });
     });
 </script>


 <script>
     $(document).ready(function() {
         const Toast = Swal.mixin({
             toast: true,
             position: "top-end",
             showConfirmButton: false,
             timer: 1000,
             timerProgressBar: true,
             didOpen: (toast) => {
                 toast.onmouseenter = Swal.stopTimer;
                 toast.onmouseleave = Swal.resumeTimer;
             }
         });

         $('#form_submit').on('submit', function(e) {
             e.preventDefault();

             var form_data = new FormData(this);
             var url = $(this).attr('action');

             var loading = `
                <button class="btn btn-success" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            `;

             var submitBtn = `
                <button type="submit" id="submitButton" class="btn btn-primary px-4">Save Changes</button>
            `;

             $('#submitButtonWrapper').html(loading);

             $.ajax({
                 url: url,
                 type: "POST",
                 data: form_data,
                 contentType: false,
                 processData: false,
                 success: function(response) {

                     $('#submitButtonWrapper').html(submitBtn);

                     if (response.status === true) {
                         Toast.fire({
                             icon: "success",
                             title: response.message
                         });
                         setTimeout(() => {

                             if (response.data.reload == true) {
                                 window.location.reload();
                             }
                         }, 1000);




                     } else {
                         Toast.fire({
                             icon: "error",
                             title: response.message
                         });
                     }
                 },
                 error: function(xhr) {
                     console.log(xhr);
                     $('#submitButtonWrapper').html(submitBtn);

                     let message = 'An unexpected error occurred.';
                     if (xhr.responseJSON) {
                         if (xhr.responseJSON.message) {
                             message = xhr.responseJSON.message;
                         } else if (xhr.responseJSON.errors) {
                             const firstError = Object.values(xhr.responseJSON.errors)[0][0];
                             message = firstError;
                         }
                     }

                     Toast.fire({
                         icon: "error",
                         title: message
                     });
                     console.error(xhr.responseText);
                 }
             });
         });
     });
 </script>

 <script>
     function deleteData(id, table) {

         Swal.fire({
             title: 'Are you sure?',
             text: "This action cannot be undone!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.isConfirmed) {

                 const Toast = Swal.mixin({
                     toast: true,
                     position: "top-end",
                     showConfirmButton: false,
                     timer: 1000,
                     timerProgressBar: true,
                     didOpen: (toast) => {
                         toast.onmouseenter = Swal.stopTimer;
                         toast.onmouseleave = Swal.resumeTimer;
                     }
                 });

                 const url = "{{ route('deleteData') }}" + "/" + id + "/" + table;

                 $.ajax({
                     url: url,
                     type: 'GET',
                     success: function(response) {
                         if (response.status === true) {
                             Toast.fire({
                                 icon: "success",
                                 title: response.message
                             });

                             if (response.data.reload) {
                                 setTimeout(() => {
                                     window.location.reload();
                                 }, 1000);
                             }

                         } else {
                             Toast.fire({
                                 icon: "error",
                                 title: response.message
                             });
                         }
                     },
                     error: function(xhr) {
                         let message = 'An unexpected error occurred.';

                         if (xhr.responseJSON) {
                             if (xhr.responseJSON.message) {
                                 message = xhr.responseJSON.message;
                             } else if (xhr.responseJSON.errors) {
                                 const firstError = Object.values(xhr.responseJSON.errors)[0][0];
                                 message = firstError;
                             }
                         }

                         Toast.fire({
                             icon: "error",
                             title: message
                         });

                         console.error(xhr.responseText);
                     }
                 });

             }
         });
     }
 </script>





 <script>

     function previewImage(e) {
         const preview = document.getElementById('img_preview');
         const file = e.target.files[0];
         if (!file) return;

         if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type))
             return alert('Only JPG, PNG, WEBP formats are allowed.');

         if (file.size > 2 * 1024 * 1024)
             return alert('Max file size is 2MB.');

         preview.src = URL.createObjectURL(file);
     }
 </script>

 <script>
     document.getElementById('name').addEventListener('input', function() {
         let name = this.value;
         let slug = name
             .toLowerCase()
             .trim()
             .replace(/[^a-z0-9\s-]/g, '') // remove special chars
             .replace(/\s+/g, '-') // spaces to dashes
             .replace(/-+/g, '-'); // collapse multiple dashes
         document.getElementById('slug').value = slug;
     });
 </script>
