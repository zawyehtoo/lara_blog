import Swal from 'sweetalert2';


const replyBtn=document.querySelectorAll('.reply-btn')
const replyBox=document.querySelector('.reply-box')
const updateBtn=document.querySelector('.update-btn')
const deleteForms = document.querySelectorAll('.delete-form');

replyBtn.forEach(btn=>{
    btn.addEventListener('click',function(){
        replyBox.classList.toggle('d-none')
    })
})

updateBtn.forEach(btn=>(
    btn.addEventListener('click',function(){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
      })
})))

deleteForms.forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        const articleId = form.getAttribute('data-article-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, submit the form
                form.submit();
            }
        });
    });
});


