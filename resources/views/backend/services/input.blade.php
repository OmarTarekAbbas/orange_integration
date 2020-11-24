
<div class="form-group row">
     <label class="control-label">Title <span class="text-danger">*</span></label>
    {!! Form::text('title', null, ['class'=>'form-control flat']) !!}
</div>
<div class="form-group row">
    <label class="control-label">productID <span class="text-danger">*</span></label>
    {!! Form::text('productID', null, ['class'=>'form-control flat']) !!}
</div>
<div class="form-group row">
    <label class="control-label">Language <span class="text-danger">*</span></label>
    {!! Form::text('lang', null, ['class'=>'form-control flat']) !!}
</div>
<div class="form-group row">
    <label class="control-label">Type <span class="text-danger">*</span></label>
    {!! Form::text('type', null, ['class'=>'form-control flat']) !!}
</div>
<div class="form-group row">
   <label class="control-label">Operator <span class="text-danger">*</span></label>
   <select name="operator_id" class='form-control flat'>
       @foreach($operators  as $operator)
       <option value="{{$operator->id}}" @if($service && $service->operator_id==$operator->id) selected @endif>{{$operator->title .' - '. $operator->country->name }}</option>
       @endforeach
   </select>
</div>
<div class="form-group row">
    <label class="control-label">URL</label>
    {!! Form::text('ExURL', null, ['class'=>'form-control flat']) !!}
</div>
<div class="form-group row">
    <label class="control-label">Size</label>
    {!! Form::text('size', null, ['class'=>'form-control flat']) !!}
</div>
<div class="form-group">
     {!! Form::submit($buttonAction,['class'=>'btn btn-primary']) !!}
</div>

