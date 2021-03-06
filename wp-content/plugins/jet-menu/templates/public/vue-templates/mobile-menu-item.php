<div
	:id="`jet-menu-item-${ itemDataObject.itemId }`"
	:class="itemClasses"
	v-on:click="itemSubHandler"
>
	<a
		class="mobile-link"
		:class="depthClass"
		:href="itemDataObject.url"
	>
		<div class="jet-menu-item-wrapper">
			<i
				class="jet-menu-icon"
				:class="itemIcon"
				v-if="isIconVisible"
			></i>
			<span class="jet-menu-name">
				<span
					class="jet-menu-label"
					v-html="itemDataObject.name"
				></span>
				<small
					class="jet-menu-desc"
					v-if="isDescVisible"
					v-html="itemDataObject.description"
				></small>
			</span>
			<small
				class="jet-menu-badge"
				v-if="isBadgeVisible"
			>
				<span class="jet-menu-badge__inner">{{ itemDataObject.badgeText }}</span>
			</small>
		</div>
	</a>
	<span
		class="jet-dropdown-arrow"
		v-if="isSub && !templateLoadStatus"
		v-html="dropdownIconHtml"
		v-on:click="maskerSubHandler"
	>
	</span>
	<div
		class="jet-mobile-menu__template-loader"
		v-if="templateLoadStatus"
	>
		<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="24px" height="25px" viewBox="0 0 128 128" xml:space="preserve">
			<g>
				<linearGradient id="linear-gradient">
					<stop offset="0%" :stop-color="loaderColor" stop-opacity="0"/>
					<stop offset="100%" :stop-color="loaderColor" stop-opacity="1"/>
				</linearGradient>
			<path d="M63.85 0A63.85 63.85 0 1 1 0 63.85 63.85 63.85 0 0 1 63.85 0zm.65 19.5a44 44 0 1 1-44 44 44 44 0 0 1 44-44z" fill="url(#linear-gradient)" fill-rule="evenodd"/>
			<animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1080ms" repeatCount="indefinite"></animateTransform>
			</g>
		</svg>
	</div>
</div>
