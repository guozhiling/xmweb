$().ready( function() {

	/* ---------- List ---------- */
	
	var $listForm = $("#listForm");// �б��
	if ($listForm.size() > 0) {
		var $searchButton = $("#searchButton");// ���Ұ�ť
		var $allCheck = $("#listTable input.allCheck");// ȫѡ��ѡ��
		var $listTableTr = $("#listTable tr:gt(0)");
		var $idsCheck = $("#listTable input[id='ids']");// ID��ѡ��
		var $deleteButton = $("#deleteButton");// ɾ����ť
		var $linkButton = $("#linkButton"); //������ť
		
		// ȫѡ
		$allCheck.click( function() {
			var $this = $(this);
			if ($this.attr("checked")) {
				$idsCheck.attr("checked", true);
				$deleteButton.attr("disabled", false);
				$listTableTr.addClass("checked");
			} else {
				$idsCheck.attr("checked", false);
				$deleteButton.attr("disabled", true);
				$listTableTr.removeClass("checked");
			}
		});
		
		// �޸�ѡ��ѡ��ʱ,ɾ����ť������
		$idsCheck.click( function() {
			var $this = $(this);
			if ($this.attr("checked")) {
				$this.parent().parent().addClass("checked");
				$deleteButton.attr("disabled", false);
			} else {
				$this.parent().parent().removeClass("checked");
				var $idsChecked = $("#listTable input[id='ids']:checked");
				if ($idsChecked.size() > 0) {
					$deleteButton.attr("disabled", false);
				} else {
					$deleteButton.attr("disabled", true)
				}
			}
		});

		// ����ɾ��
		$deleteButton.click( function() {
			$.dialog({type: "warn", content: msg9, ok: msg10, cancel: msg11, modal: true, okCallback: batchDelete});
			function batchDelete() {
				$listForm.submit();
			}
		});

		
		// ����
		$searchButton.click( function() {
			$pageNumber.val("1");
			$listForm.submit();
		});
		
		//��λ�������
		$linkButton.click( function() {
			$listForm.submit();
		});
	}
	
});