
@section('header') Message Parents @endsection
<div wire:id="fees" class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5"><h3>Send Notification</h3></div>

                    <form class="forms-sample"  wire:submit.prevent="sendNotification" >

                        <div class="form-group">
                            <label for="message">Enter Message</label>
                            <textarea  wire:model.defer="message_body" class="form-control" id="message" rows="4"></textarea>
                            @error('message_body')<span class="text-danger text-small">{{ $message }}</span> @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Send Message</button>



                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
