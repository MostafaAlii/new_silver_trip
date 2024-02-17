<div class="modal fade" id="create{{ $title }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('general.create') .' '. $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('states.store')}}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Start Code -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" required name="name" id="name" value="">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-1 form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option selected disabled>Select {{$title}} Status...</option>
                                    <option value="1" {{ old('status')==1 ? 'selected' : '' }}>{{
                                        trans('general.active') }}</option>
                                    <option value="0" {{ old('status')==0 ?'selected' : '' }}>{{
                                        trans('general.inactive') }}</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- End Code -->
                        <div class="col-4">
                            <div class="form-group p-1">
                                <label for="country_id">Country</label>
                                <select name="country_id" class="form-control">
                                    <option selected disabled>Select {{$title}} Country...</option>
                                    @forelse ($countries as $country)
                                    <option value="{{$country->id}}" {{ old('country') == $country->id ? 'selected' : '' }}>{{
                                        $country->name }}
                                    </option>
                                    @empty
                                    <option value="0">No Country</option>
                                    @endforelse
                                </select>
                                @error('country_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('general.close')
                            }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('general.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>