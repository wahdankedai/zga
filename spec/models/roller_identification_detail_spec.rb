require 'spec_helper'

describe RollerIdentificationDetail do
  before(:each) do
    ItemType.setup_item_type
    @warehouse = Warehouse.create_object(
      :name => "warehouse awesome",
      :description => "Badaboom"
    )
    
    @contact = Contact.create_object(
      :name             => "Contact"           ,
      :description      => "Description"      ,
      :address          =>  "Address"        ,
      :shipping_address => "Shipping Address"
    )
    
    
    @item_sku = 'itemsku'
    
    @item_type = ItemType.create_object(
      :name => "Others",
      :description => "on off item"
    )
    
    
    
    @item = Item.create_object(
    :sku            => @item_sku,
    :description    => "awesome description", 
    :standard_price => BigDecimal("150000"),
    :item_type_id => @item_type.id
    )
    
    @core_builder_base_sku_1 = "332211"
    @core_builder_new_core_sku_1 = "332211U"
    @core_builder_used_core_sku_1 = "332211N"
    
    @compound_1 = Compound.create_object(
    :compound_sku            => "compo1",
    :description    => "awesome description" 
    )
    
    @core_builder_1 = CoreBuilder.create_object(
      :used_core_sku => @core_builder_used_core_sku_1 ,          
      :new_core_sku  =>  @core_builder_new_core_sku_1,
      :base_core_sku => @core_builder_base_sku_1,
      :description   =>  "Awesome core"
    )
    
    @roller_builder_base_sku_1 = "R332211"
    @roller_builder_new_core_sku_1 = "R332211U"
    @roller_builder_used_core_sku_1 = "R332211N"
    
    
    
    @roller_builder_1 = RollerBuilder.create_object(
      :roller_used_core_sku => @roller_builder_used_core_sku_1     ,     
      :roller_new_core_sku  => @roller_builder_new_core_sku_1   ,
      :base_roller_sku      => @roller_builder_base_sku_1       ,
      :compound_id          => @compound_1.id           ,
      :description          => "awesome bla bla bla"          ,
      :core_builder_id      => @core_builder_1.id
    )
    
    # roller builder 2 
    
    @core_builder_base_sku_2 =      "2_332211"
    @core_builder_new_core_sku_2 =  "2_332211U"
    @core_builder_used_core_sku_2 = "2_332211N"
    
    @compound_2 = Compound.create_object(
    :compound_sku            => "compo2",
    :description    => "awesome description" 
    )
    
    @core_builder_2 = CoreBuilder.create_object(
      :used_core_sku => @core_builder_used_core_sku_2 ,          
      :new_core_sku  =>  @core_builder_new_core_sku_2,
      :base_core_sku => @core_builder_base_sku_2,
      :description   =>  "Awesome core"
    )
    
    @roller_builder_base_sku_2 =      "2_R332211"
    @roller_builder_new_core_sku_2 =  "2_R332211U"
    @roller_builder_used_core_sku_2 = "2_R332211N"
    
    
    
    @roller_builder_2 = RollerBuilder.create_object(
      :roller_used_core_sku => @roller_builder_used_core_sku_2     ,     
      :roller_new_core_sku  => @roller_builder_new_core_sku_2   ,
      :base_roller_sku      => @roller_builder_base_sku_2       ,
      :compound_id          => @compound_2.id           ,
      :description          => "awesome bla bla bla"          ,
      :core_builder_id      => @core_builder_2.id
    )
    
    @ri = RollerIdentification.create_object(
      :identification_date => DateTime.now  , 
      :description         => "awesome"          ,
      :warehouse_id        => @warehouse.id         ,
      :contact_id          => @contact.id           ,
      :is_self_production  => false   ,
      :description         => "awesome"
    )
  end
    
  
  it "should allow roller identification detail creation" do

    @received_quantity = 1 
    @ri_detail = RollerIdentificationDetail.create_object(
      :roller_identification_id => @ri.id , 
      :core_builder_id          =>  @core_builder_1.id ,
      :is_new_core              =>  false, 
      :identification_code      =>  "2014/1/1/1/A", 
      :description              =>  " awesome yoshinoya"
    )
    
    @ri_detail.should be_valid 
  end
  
 
  
  context "created ri_detail" do
    before(:each) do
      @received_quantity = 1 
    
      
      @ri_detail = RollerIdentificationDetail.create_object(
        :roller_identification_id => @ri.id , 
        :core_builder_id          =>  @core_builder_1.id, 
        :is_new_core              =>  false, 
        :identification_code      =>  "2014/1/1/1/A", 
        :description              =>  " awesome yoshinoya"
      )
    end
    
    it "should have unique identification_code" do
      @ri_detail_2 = RollerIdentificationDetail.create_object(
        :roller_identification_id => @ri.id , 
        :core_builder_id          =>  @core_builder_1.id, 
        :is_new_core              =>  false, 
        :identification_code      =>  "2014/1/1/1/A", 
        :description              =>  " awesome yoshinoya"
      )
      
      @ri_detail_2.errors.size.should_not == 0 
    end
    
    
    
    it "should be updatable" do
      @ri_detail.update_object(
        :roller_identification_id => @ri.id , 
        :core_builder_id          =>  @core_builder_1.id, 
        :is_new_core              =>  false, 
        :identification_code      =>  "2014/1/1/1/C", 
        :description              =>  " awesome yoshinoya"
      )
      
      @ri_detail.errors.messages.each {|x| puts "err: #{x}"}
      
      @ri_detail.errors.size.should == 0
      @ri_detail.should be_valid 
    end
    
    
    
    
   
    
    it "should be deletable" do
      @ri_detail.delete_object
      @ri_detail.persisted?.should be_false
    end
     
    context "created 2 purchase receival detail" do
      before(:each) do
        @ri_detail_2 = RollerIdentificationDetail.create_object(
          :roller_identification_id => @ri.id , 
          :core_builder_id          =>  @core_builder_1.id, 
          :is_new_core              =>  false, 
          :identification_code      =>  "2014/1/1/1/B", 
          :description              =>  " awesome yoshinoya"
        )
      end 
      
      it "should create pr_detail_2" do
        @ri_detail_2.errors.size.should == 0 
        @ri_detail_2.should be_valid
      end
      
     
      
      it "should  allwo self update " do
        @ri_detail_2.update_object(
          :roller_identification_id => @ri.id , 
          :core_builder_id          =>  @core_builder_1.id, 
          :is_new_core              =>  false, 
          :identification_code      =>  "2014/1/1/1/B", 
          :description              =>  " awesome yoshinoya"
        )
        
        @ri_detail_2.errors.messages.each {|x| puts "Error: #{x}"}
        @ri_detail_2.errors.size.should == 0 
      
      end
      
      it "should have unique identification_code upon update" do
         

        @ri_detail_2.update_object(
          :roller_identification_id => @ri.id , 
          :core_builder_id          =>  @core_builder_1.id, 
          :is_new_core              =>  false, 
          :identification_code      =>  "2014/1/1/1/A", 
          :description              =>  " awesome yoshinoya"
        )

        @ri_detail.errors.size.should == 0 
      end
    end
  end
  
end
