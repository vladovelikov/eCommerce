<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label>Website Name</label>
                    <input type="text" name="website_name" class="form-control" value="{{old('website_name')}}">
                </div>
                <div class="form-group">
                    <label>Layout</label>
                    <select name="layout" class="form-control" id="">
                        <option value="LTR">LTR</option>
                        <option value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" name="contact_email" class="form-control" value="{{old('contact_email')}}">
                </div>
                <div class="form-group">
                    <label>Default Currency</label>
                    <select name="currency" class="form-control" id="currency">
                        <option value="LTR">LTR</option>
                        <option value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <select name="currency_icon" class="form-control" id="currency_icon">
                        <option value="LTR">LTR</option>
                        <option value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Timezone</label>
                    <select name="timezone" class="form-control" id="timezone">
                        <option value="LTR">LTR</option>
                        <option value="RTL">RTL</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

</div>
