$(document).ready(function () {
   // Fetch services from the database
   $.ajax({
      url: 'get-services.php',
      method: 'GET',
      success: function (data) {
         const services = JSON.parse(data);

         // Populate the first row
         populateServiceDropdown($('#itemsBody tr:first select'), services);

         // Add Item button
         $('#addItem').click(function () {
            const newRow = `
              <tr>
                <td>
                  <select class="form-select serviceSelect" name="service[]">
                        <option value="">Select a service</option>
                  </select>
               </td>
               <td><input type="number" class="form-control qty" name="qty[]" value="1"></td>
               <td><input type="number" class="form-control servicePrice" name="servicePrice[]" value="0" readonly></td>
               <td><input type="number" class="form-control amount" name="amount[]" value="0" readonly></td>
               <td><button type="button" class="btn btn-danger btn-sm removeRow">Remove</button></td>ton type="button" class="btn btn-danger btn-sm removeRow">Remove</button></td>
              </tr>
            `;
            const $newRow = $(newRow);
            $('#itemsBody').append($newRow);

            // Populate the dropdown in the new row
            populateServiceDropdown($newRow.find('select'), services);
          });

         // On service change, update price and amount
         $(document).on('change', '.serviceSelect', function () {
            const price = $(this).find(':selected').data('price') || 0;
            const $row = $(this).closest('tr');
            $row.find('.servicePrice').val(price);
            const qty = parseInt($row.find('.qty').val()) || 1;
            $row.find('.amount').val(qty * price);
         });

         // On quantity change, recalculate amount
         $(document).on('input', '.qty', function () {
            const $row = $(this).closest('tr');
            const qty = parseInt($(this).val()) || 1;
            const price = parseFloat($row.find('.servicePrice').val()) || 0;
            $row.find('.amount').val(qty * price);
         });

         // Remove row
         $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
            calculateTotals();
         });
      },
      error: function (err) {
         console.log("Error fetching services:", err);
      }
   });

   // Helper to populate a <select> element
   function populateServiceDropdown($select, services) {
      services.forEach(service => {
         $select.append(
         $('<option>', {
            value: service.service_id,
            text: service.service_name,
            'data-price': service.price
         })
         );
         $select.addClass('serviceSelect');
      });
   }

   function calculateRowAmount($row) {
      const qty = parseFloat($row.find('.qty').val()) || 0;
      const price = parseFloat($row.find('.servicePrice').val()) || 0;
      const amount = qty * price;
      $row.find('.amount').val(amount.toFixed(2));
      return amount;
    }
  
   function calculateTotals() {
      let subtotal = 0;
      $('#itemsBody tr').each(function () {
         subtotal += calculateRowAmount($(this));
      });
      $('#subTotal').val(subtotal.toFixed(2));

      const fee = parseFloat($('#addOn').val()) || 0;
      const total = subtotal + fee;
      $('#totalAmount').val(total.toFixed(2));
      }

      // Trigger on quantity or price change
      $(document).on('input', '.qty, .servicePrice', function () {
      calculateTotals();
      });

      // Trigger on courier fee input
      $('#addOn').on('input', function () {
      calculateTotals();
      });

      // Trigger on service selection (if it affects price)
      $(document).on('change', '.serviceSelect', function () {
      const price = $(this).find(':selected').data('price') || 0;
      const $row = $(this).closest('tr');
      $row.find('.servicePrice').val(price);
      calculateTotals();
   });

   // Initial calculation
   calculateTotals();
});
