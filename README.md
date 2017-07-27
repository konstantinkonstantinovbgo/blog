# blog
jQuery DataTables API for Laravel 4|5

INSTALLATION
composer install

Grid generator processing
https://datatables.yajrabox.com/service

Wish-list

I. Appearance
	1. Adding custom classes or id on table.

	Example:
	{!! $dataTable->table(['class' => 'table table-bordered', 'id' => 'table-id']) !!}

II. Processing
	1. Server-side.
	2. Client-side

III. Filtering / searching
	1. Basic.
	2. inject the whole filter in a component (wrapper) – for example with separate “renderFilter” method (respectively there should be such also for separate grid rendering)
Custom components like:
		a) an auto-completer instead of the default text input) via custom template coming from a partial
		b) chained selects / drop downs
		c) inject template between the filter and the grid rendered - (like short/overall) stats

	3. Footer.

IV. Buttons (common or per row item):
	1. Create / New
	2. Edit
	3. Delete
	4. Duplicate
	5. Export
		a) csv
		b) pdf
		c) excel
		d) reset 
		e) reload
	6. Print
	7. Reset
	8. Reload

V. Columns
	1. Sorting (server side)
	2. custom sorting (for example when there is a column containing info from 2 DB columns – like user.name, user.email)
VI. Rows listing.
	1. Add, edit (action) buttons.	
	2. Delete (action) button.
		a) delete only after confirmation
	3. Show font-awesome icons or some text in html.
	4. Coloring rows.	
VII. Master and Details Table

VII. Editing.
	1. Inline.
	2. Buble.
	3. Bulk /multiple items. 
