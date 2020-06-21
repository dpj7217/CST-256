<div class="form-row">
    <div class="form-group col">

        <label for="<?php echo "companyName" . $index ?>">Company Name</label>
        <input type="text" class="form-control" id="<?php echo "companyName" . $index ?>" name="<?php echo "companyName" . $index?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-6">
        <label for="<?php echo "from" . $index?>">From</label>
        <input type="date" name="<?php echo "from" . $index?>" id="<?php echo "from" . $index?>" class="form-control">
    </div>
    <div class="form-group col-6">
        <label for="<?php echo "to" . $index?>">From</label>
        <input type="date" name="<?php echo "to" . $index?>" id="<?php echo "to" . $index?>" class="form-control">
    </div>
</div>
<div class="form-row">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" value="1" id="<?php echo $index . "isCurrent"?>">
        <label for="<?php echo $index . "isCurrent"?>" class="form-check-label">I Currently Work Here</label>
    </div>
</div>
