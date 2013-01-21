function confirmDelete (itemToDelete)
{
	alert ('in function');
	if (window.confirm("Are you sure you want to delete" + itemToDelete);
	{
		return true;
	}
	else
	{
		return false;
	}
}