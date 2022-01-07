<style>
    .image-upload-one{
        display: flex;
        justify-content: center;
      }
      
      .center {
        display:inline;
        margin: 3px;
      }
    
      .form-input input {
        display:none;
      }
      
      .form-input img {
        width:150px;
        height: 150px;
        margin: 2px;
      }
    
      .small{
        color: #fff;
      }
    
      @media only screen and (max-width: 700px){
        .image-upload-container{
          grid-template-areas: 'img-u-one img-u-two img-u-three'
           'img-u-four img-u-five img-u-six';
        }
      }
    </style>
    
    <form action="{{ route('buyer.update_image', $user->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2 class="text-center">
            {{__('Update Your Image')}}
        </h2>
    
        <div class="image-upload-container">
            <div class="image-upload-one text-center">
              <div class="center">
                <label for="update image">{{ __('Select image to upload new one')}}</label>
    
                <div class="form-input text-center">
                  <label for="file-ip-1">
                    <img id="file-ip-1-preview" title="select to update" src="{{ asset($user->image) }}" class="card-img-top">
                  </label>
                  <input type="file"  name="image" id="file-ip-1" accept="image/*" onchange="showPreview(event, 1);">
                  @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                  @enderror
                </div>
                <button type="button" class="btn btn-warning imgRemove" onclick="myImgRemove(1)">{{ __("Reset")}}</button>
              </div>
            </div>
        </div>
        <br>
        <br>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">{{__('Update')}}</button>
            <button type="button" class="btn btn-secondary" onClick="removeBackdrop()" data-dismiss="modal">{{__('Cancel')}}</button>
        </div>
    </form>
    
        <script>
            var number = 1;
            do {
            function showPreview(event, number){
                if(event.target.files.length > 0){
                let src = URL.createObjectURL(event.target.files[0]);
                let preview = document.getElementById("file-ip-"+number+"-preview");
                preview.src = src;
                preview.style.display = "block";
                } 
            }
            function myImgRemove(number) {
                document.getElementById("file-ip-"+number+"-preview").src = "{{ asset($user->image) }}";
                document.getElementById("file-ip-"+number).value = null;
            }
            number++;
            }
            while (number < 5);
        </script>
    
    