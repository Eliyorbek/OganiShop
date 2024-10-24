<div>
    <style>
        .input-switch{
            display: none;
        }

        .label-switch{
            display: inline-block;
            position: relative;
        }

        .label-switch::before, .label-switch::after{
            content: "";
            display: inline-block;
            cursor: pointer;
            transition: all 0.5s;
        }

        .label-switch::before {
            width: 3em;
            height: 1em;
            border: 1px solid #757575;
            border-radius: 4em;
            background: #888888;
        }

        .label-switch::after {
            position: absolute;
            left: 0;
            top: -20%;
            width: 1.5em;
            height: 1.5em;
            border: 1px solid #757575;
            border-radius: 4em;
            background: #ffffff;
        }

        .input-switch:checked ~ .label-switch::before {
            background: #00a900;
            border-color: #008e00;
        }

        .input-switch:checked ~ .label-switch::after {
            left: unset;
            right: 0;
            background: #00ce00;
            border-color: #009a00;
        }

        .info-text {
            display: inline-block;
        }

        .info-text::before{
            content: "Not active";
        }

        .input-switch:checked ~ .info-text::before{
            content: "Active";
        }
    </style>


    <div class="form-group col-6">
        <label for="">Status</label><br>
        <input class='input-switch' type="checkbox" name="status" <?=$model->status=='active'?'checked':''?> id="demo"/>
        <label class="label-switch" for="demo"></label>
        <span class="info-text"></span>
    </div>
</div>

