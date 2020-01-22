<div id="createpanel">
	<table>
		<tr>
			<td>
				<select name = "selectfontfamily" class = 'panselect' id = "selectfontfamily" onchange = "iFontName(this.value)" title = "Шрифт">
					<option selected="selected" disabled>Font Family</option><option>Verdana</option><option>Arial</option><option>Times New Roman</option><option>Calibri</option><option>Consolas</option>
				</select>
				<select name = "selectfontsize" class = 'panselect' id = "selectfontsize" onchange = "iFontSize(this.value)" title = "Размер шрифта">
					<option selected="selected" disabled>Size</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option>
				</select>
				<select name = "selectheading"  class = 'panselect' id = "selectheading" onchange = "iHeading(this.value)" title = "Заголовок">
					<option selected="selected" disabled>Head</option><option value = 'p'>none</option><option>H1</option><option>H2</option><option>H3</option><option>H4</option><option>H5</option><option>H6</option>
				</select>
			</td>
			<td>
				<span id="сolorpanelon" onclick="showcolorpanel('colorpanel2')">Text color</span>
				<div id="colorpanelclose" onmousedown="closecolorpanel()"></div>
				<div id="colorpanel2" class="colorpanel">
					Выберете цвет:<br>
					<div class="pcolors" style="background: #a31515;" onclick="iForeColor('#a31515')"></div>
					<div class="pcolors" style="background: #ff0000;" onclick="iForeColor('#ff0000')"></div>
					<div class="pcolors" style="background: #ffc000;" onclick="iForeColor('#ffc000')"></div>
					<div class="pcolors" style="background: #ffff00;" onclick="iForeColor('#ffff00')"></div>
					<div class="pcolors" style="background: #92d050;" onclick="iForeColor('#92d050')"></div>
					<div class="pcolors" style="background: #00b050;" onclick="iForeColor('#00b050')"></div>
					<div class="pcolors" style="background: #008000;" onclick="iForeColor('#008000')"></div>
					<div class="pcolors" style="background: #00b0f0;" onclick="iForeColor('#00b0f0')"></div><br>
					<div class="pcolors" style="background: #0070c0;" onclick="iForeColor('#0070c0')"></div>
					<div class="pcolors" style="background: #0000ff;" onclick="iForeColor('#0000ff')"></div>
					<div class="pcolors" style="background: #002060;" onclick="iForeColor('#002060')"></div>
					<div class="pcolors" style="background: #7030a0;" onclick="iForeColor('#7030a0')"></div>
					<div class="pcolors" style="background: #000000;" onclick="iForeColor('#000000')"></div>
					<div class="pcolors" style="background: #808080;" onclick="iForeColor('#808080')"></div>					
					<div class="pcolors" style="background: #bfbfbf;" onclick="iForeColor('#bfbfbf')"></div>
					<div class="pcolors" style="background: #ffffff;" onclick="iForeColor('#ffffff')"></div>	
				</div>
			</td>
			<td>
				<span onClick="iUnorderedList()" title="Нумерованный список">UL</span>
				<span onClick="iOrderedList()" title="Маркированный список">OL</span>
				<span onClick="iHorizontalRule()" title="Горизонтальная линия">HR</span>
				<span onClick="iSpoiler()" title="Спойлер">SP</span>
			</td>
			<td>
				<span onClick="iImage()" class="cpspanimg2">Image</span><span class="cpspanimg3">
				<a Onclick="uploadon()"><img src="img/icons/upload.png" id="cpimgup" onmouseover="this.src='img/icons/upload2.png'" onmouseout="this.src='img/icons/upload.png'"></a></span>				
				<span onClick="iRemoveFormat()" title="Убрать форматирование">F<sub>R</sub></span>
			</td>
		</tr>
		<tr>
			<td>
				<span onClick="iBold()" title="Полужирный"><b>B</b></span>
				<span onClick="iItalic()" title="Курсив"><i>I</i></span>
				<span onClick="iUnderline()" title="Подчеркнутый"><u>U</u></span>
				<span onClick="iStrikeThrough()" title="Зачеркнутый"><strike>S</strike></span>
				<span onClick="iSubscript()" class="cpspanimg" title="Подстрочный индекс"><img src="img/icons/sub.png" onmouseover="this.src='img/icons/sub2.png'" onmouseout="this.src='img/icons/sub.png'"></span>
				<span onClick="iSuperscript()" class="cpspanimg" title="Надстрочный индекс"><img src="img/icons/sup.png" onmouseover="this.src='img/icons/sup2.png'" onmouseout="this.src='img/icons/sup.png'"></span>
				<span onClick="iSelectAll()" title="Выбрать все">All</span>
			</td>
			<td>
				<span id="сolorpanelon" onclick="showcolorpanel('colorpanel1')">Font Hilite</span>
				<div id="colorpanelclose" onmousedown="closecolorpanel()"></div>
				<div id="colorpanel1" class="colorpanel">
					Выберете цвет:<br>
					<div class="pcolors" style="background: #c00000;" onclick="iHiliteColor('#c00000')"></div>
					<div class="pcolors" style="background: #ff0000;" onclick="iHiliteColor('#ff0000')"></div>
					<div class="pcolors" style="background: #ffc000;" onclick="iHiliteColor('#ffc000')"></div>
					<div class="pcolors" style="background: #ffff00;" onclick="iHiliteColor('#ffff00')"></div>
					<div class="pcolors" style="background: #92d050;" onclick="iHiliteColor('#92d050')"></div>
					<div class="pcolors" style="background: #00b050;" onclick="iHiliteColor('#00b050')"></div>
					<div class="pcolors" style="background: #00b0f0;" onclick="iHiliteColor('#00b0f0')"></div><br>
					<div class="pcolors" style="background: #0070c0;" onclick="iHiliteColor('#0070c0')"></div>
					<div class="pcolors" style="background: #002060;" onclick="iHiliteColor('#002060')"></div>
					<div class="pcolors" style="background: #7030a0;" onclick="iHiliteColor('#7030a0')"></div>
					<div class="pcolors" style="background: #000000;" onclick="iHiliteColor('#000000')"></div>
					<div class="pcolors" style="background: #808080;" onclick="iHiliteColor('#808080')"></div>					
					<div class="pcolors" style="background: #bfbfbf;" onclick="iHiliteColor('#bfbfbf')"></div>
					<div class="pcolors" style="background: #ffffff;" onclick="iHiliteColor('#ffffff')"></div>	
				</div>
			</td>
			<td>
				<span onClick="iJustifyLeft()" class="cpspanimg" title="Выровнять по левому краю"><img src="img/icons/tal.png" onmouseover="this.src='img/icons/tal2.png'" onmouseout="this.src='img/icons/tal.png'"></span>
				<span onClick="iJustifyCenter()" class="cpspanimg" title="Выровнять по центру"><img src="img/icons/tac.png" onmouseover="this.src='img/icons/tac2.png'" onmouseout="this.src='img/icons/tac.png'"></span>
				<span onClick="iJustifyRight()" class="cpspanimg" title="Выровнять по правому краю"><img src="img/icons/tar.png" onmouseover="this.src='img/icons/tar2.png'" onmouseout="this.src='img/icons/tar.png'"></span>
				<span onClick="iJustifyFull()" class="cpspanimg" title="Выровнять по ширине"><img src="img/icons/taf.png" onmouseover="this.src='img/icons/taf2.png'" onmouseout="this.src='img/icons/taf.png'"></span>
			</td>
			<td>
				<span onClick="iLink()" title="Вставить ссылку">Link</span>
				<span onClick="iUnLink()" title="Удалить ссылку">UnLink</span>
			</td>
		</tr>
	</table>		
</div>